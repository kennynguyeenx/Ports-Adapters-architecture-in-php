<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure\Doctrine\Cache;

use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\CacheProvider;
use Psr\Log\LoggerInterface;
use Redis;
use RedisCluster;

/**
 * Class RedisClusterCache
 * @package Kennynguyeenx\LibraryHexagonal\Infrastructure\Doctrine\Cache
 */
class RedisClusterCache extends CacheProvider
{
    /**
     * @var RedisCluster
     */
    protected $redisCluster;
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * RedisCache constructor.
     * @param RedisCluster $redisCluster
     * @param string $nameSpace
     * @param LoggerInterface $logger
     */
    public function __construct(RedisCluster $redisCluster, string $nameSpace, LoggerInterface $logger)
    {
        parent::setNamespace($nameSpace);
        $redisCluster->setOption(RedisCluster::OPT_SERIALIZER, $this->getSerializerValue());
        $this->redisCluster = $redisCluster;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    protected function doFetch($id)
    {
        try {
            return $this->redisCluster->get($id);
        } catch (\Exception $exception) {
            $this->logger->error(
                $exception->getMessage(),
                ['catch_class' => static::class, 'stack_trace' => $exception->getTrace()[0]]
            );
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function doFetchMultiple(array $keys): array
    {
        try {
            $fetchedItems = array_combine($keys, $this->redisCluster->mget($keys));

            // Redis mget returns false for keys that do not exist. So we need to filter those out unless it's the real data.
            $keysToFilter = array_keys(array_filter($fetchedItems, static function ($item): bool {
                return $item === false;
            }));

            if ($keysToFilter) {
                $multi = $this->redisCluster->multi(Redis::PIPELINE);
                foreach ($keysToFilter as $key) {
                    $multi->exists($key);
                }
                $existItems = array_filter($multi->exec());
                $missedItemKeys = array_diff_key($keysToFilter, $existItems);
                $fetchedItems = array_diff_key($fetchedItems, array_fill_keys($missedItemKeys, true));
            }

            return $fetchedItems;
        } catch (\Exception $exception) {
            $this->logger->error(
                $exception->getMessage(),
                ['catch_class' => static::class, 'stack_trace' => $exception->getTrace()[0]]
            );
            return [];
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function doSaveMultiple(array $keysAndValues, $lifetime = 0): bool
    {
        try {
            if ($lifetime) {
                // Keys have lifetime, use SETEX for each of them
                $multi = $this->redisCluster->multi(Redis::PIPELINE);
                foreach ($keysAndValues as $key => $value) {
                    $multi->setex($key, $lifetime, $value);
                }
                $succeeded = array_filter($multi->exec());

                return count($succeeded) == count($keysAndValues);
            }

            // No lifetime, use MSET
            return (bool)$this->redisCluster->mset($keysAndValues);
        } catch (\Exception $exception) {
            $this->logger->error(
                $exception->getMessage(),
                ['catch_class' => static::class, 'stack_trace' => $exception->getTrace()[0]]
            );
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function doContains($id): bool
    {
        try {
            $exists = $this->redisCluster->exists($id);

            if (is_bool($exists)) {
                return $exists;
            }

            return $exists > 0;
        } catch (\Exception $exception) {
            $this->logger->error(
                $exception->getMessage(),
                ['catch_class' => static::class, 'stack_trace' => $exception->getTrace()[0]]
            );
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function doSave($id, $data, $lifeTime = 0): bool
    {
        try {
            if ($lifeTime > 0) {
                return $this->redisCluster->setex($id, $lifeTime, $data);
            }

            return $this->redisCluster->set($id, $data);
        } catch (\Exception $exception) {
            $this->logger->error(
                $exception->getMessage(),
                ['catch_class' => static::class, 'stack_trace' => $exception->getTrace()[0]]
            );
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function doDelete($id): bool
    {
        try {
            return $this->redisCluster->del($id) >= 0;
        } catch (\Exception $exception) {
            $this->logger->error(
                $exception->getMessage(),
                ['catch_class' => static::class, 'stack_trace' => $exception->getTrace()[0]]
            );
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function doDeleteMultiple(array $keys): bool
    {
        try {
            return $this->redisCluster->del($keys) >= 0;
        } catch (\Exception $exception) {
            $this->logger->error(
                $exception->getMessage(),
                ['catch_class' => static::class, 'stack_trace' => $exception->getTrace()[0]]
            );
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function doFlush(): bool
    {
        try {
            foreach ($this->redisCluster->_masters() as $master) {
                $this->redisCluster->flushDB($master);
            }

            return true;
        } catch (\Exception $exception) {
            $this->logger->error(
                $exception->getMessage(),
                ['catch_class' => static::class, 'stack_trace' => $exception->getTrace()[0]]
            );
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function doGetStats(): ?array
    {
        try {
            $info = $this->redisCluster->info('STATS');

            return [
                Cache::STATS_HITS   => $info['keyspace_hits'],
                Cache::STATS_MISSES => $info['keyspace_misses'],
                Cache::STATS_UPTIME => $info['uptime_in_seconds'],
                Cache::STATS_MEMORY_USAGE      => $info['used_memory'],
                Cache::STATS_MEMORY_AVAILABLE  => false,
            ];
        } catch (\Exception $exception) {
            $this->logger->error(
                $exception->getMessage(),
                ['catch_class' => static::class, 'stack_trace' => $exception->getTrace()[0]]
            );
            return null;
        }
    }

    /**
     * Returns the serializer constant to use. If Redis is compiled with
     * igbinary support, that is used. Otherwise the default PHP serializer is
     * used.
     *
     * @return int One of the Redis::SERIALIZER_* constants
     */
    protected function getSerializerValue(): int
    {
        if (defined('Redis::SERIALIZER_IGBINARY') && extension_loaded('igbinary')) {
            return Redis::SERIALIZER_IGBINARY;
        }

        return Redis::SERIALIZER_PHP;
    }
}
