<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure\Doctrine\DBAL\Driver\Mysqli;

use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\Driver\Mysqli\MysqliException;
use Doctrine\DBAL\Driver\Mysqli\MysqliStatement;
use Doctrine\DBAL\Driver\PingableConnection;
use Doctrine\DBAL\Driver\ServerInfoAwareConnection;

/**
 * Class MysqliConnection
 * @package namespace Coccoc\Component\Doctrine\DBAL\Driver\Mysqli;
 */
class MysqliConnection implements Connection, PingableConnection, ServerInfoAwareConnection
{
    /**
     * Name of the option to set connection flags
     */
    const OPTION_FLAGS = 'flags';

    /**
     * @var \mysqli
     */
    private $connection;

    /**
     * @param array $params
     * @param string $username
     * @param string $password
     * @param array $driverOptions
     *
     * @throws MysqliException
     * @throws \Exception
     */
    public function __construct(array $params, $username, $password, array $driverOptions = [])
    {
        set_error_handler(
            function () {
                // Do nothing
            }
        );

        $hostArray = explode(',', $params['host']);
        shuffle($hostArray);
        foreach ($hostArray as $host) {
            list($host, $port) = explode(':', $host);
            if (!$port) {
                $port = 3306;
            }
            $connectParams = $params;
            $connectParams['host'] = (string)$host;
            $connectParams['port'] = intval($port);

            $this->connection = $this->connectToServer($connectParams);
            if ($this->connection instanceof \mysqli) {
                break;
            }
        }

        if (!$this->connection instanceof \mysqli) {
            restore_error_handler();
            if (is_object($this->connection)) {
                throw new MysqliException(
                    $this->connection->connect_error,
                    @$this->connection->sqlstate ?: 'HY000',
                    $this->connection->connect_errno
                );
            } else {
                throw new \Exception(
                    'Can not connect Database'
                );
            }
        }

        $this->setSecureConnection($params);
        $this->setDriverOptions($driverOptions);

        restore_error_handler();
    }

    /**
     * @param $config
     * @return \mysqli|null
     */
    private function connectToServer($config)
    {
        $mysqli = mysqli_init();

        $mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);

        $isConnected = $mysqli->real_connect(
            $config['host'],
            $config['username'],
            $config['password'],
            $config['database'],
            $config['port']
        );

        if (!$isConnected) {
            return null;
        }

        // Check that node is ready. Ping does not work properly https://bugs.php.net/bug.php?id=67564 */
        $mysqli->query('SELECT 1');

        if ($mysqli->errno) {
            $mysqli->close();

            return null;
        }

        if (array_key_exists('charset', $config)) {
            $mysqli->set_charset($config['charset']);
        }

        return $mysqli;
    }


    /**
     * Retrieves mysqli native resource handle.
     *
     * Could be used if part of your application is not using DBAL.
     *
     * @return \mysqli
     */
    public function getWrappedResourceHandle()
    {
        return $this->connection;
    }

    /**
     * {@inheritdoc}
     */
    public function getServerVersion()
    {
        $majorVersion = floor($this->connection->server_version / 10000);
        $minorVersion = floor(($this->connection->server_version - $majorVersion * 10000) / 100);
        $patchVersion = floor($this->connection->server_version - $majorVersion * 10000 - $minorVersion * 100);

        return $majorVersion . '.' . $minorVersion . '.' . $patchVersion;
    }

    /**
     * {@inheritdoc}
     */
    public function requiresQueryForServerVersion()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function prepare($prepareString)
    {
        return new MysqliStatement($this->connection, $prepareString);
    }

    /**
     * {@inheritdoc}
     */
    public function query()
    {
        $args = func_get_args();
        $sql = $args[0];
        $stmt = $this->prepare($sql);
        $stmt->execute();

        return $stmt;
    }

    /**
     * {@inheritdoc}
     */
    public function quote($input, $type = \PDO::PARAM_STR)
    {
        return "'". $this->connection->escape_string($input) ."'";
    }

    /**
     * {@inheritdoc}
     */
    public function exec($statement)
    {
        if (false === $this->connection->query($statement)) {
            throw new MysqliException($this->connection->error, $this->connection->sqlstate, $this->connection->errno);
        }

        return $this->connection->affected_rows;
    }

    /**
     * {@inheritdoc}
     */
    public function lastInsertId($name = null)
    {
        return $this->connection->insert_id;
    }

    /**
     * {@inheritdoc}
     */
    public function beginTransaction()
    {
        $this->connection->query('START TRANSACTION');

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function commit()
    {
        return $this->connection->commit();
    }

    /**
     * {@inheritdoc}non-PHPdoc)
     */
    public function rollBack()
    {
        return $this->connection->rollback();
    }

    /**
     * {@inheritdoc}
     */
    public function errorCode()
    {
        return $this->connection->errno;
    }

    /**
     * {@inheritdoc}
     */
    public function errorInfo()
    {
        return $this->connection->error;
    }

    /**
     * Apply the driver options to the connection.
     *
     * @param array $driverOptions
     *
     * @throws MysqliException When one of of the options is not supported.
     * @throws MysqliException When applying doesn't work - e.g. due to incorrect value.
     */
    private function setDriverOptions(array $driverOptions = [])
    {
        $supportedDriverOptions = [
            \MYSQLI_OPT_CONNECT_TIMEOUT,
            \MYSQLI_OPT_LOCAL_INFILE,
            \MYSQLI_INIT_COMMAND,
            \MYSQLI_READ_DEFAULT_FILE,
            \MYSQLI_READ_DEFAULT_GROUP,
        ];

        if (defined('MYSQLI_SERVER_PUBLIC_KEY')) {
            $supportedDriverOptions[] = \MYSQLI_SERVER_PUBLIC_KEY;
        }

        $exceptionMsg = "%s option '%s' with value '%s'";

        foreach ($driverOptions as $option => $value) {
            if ($option === static::OPTION_FLAGS) {
                continue;
            }

            if (!in_array($option, $supportedDriverOptions, true)) {
                throw new MysqliException(
                    sprintf($exceptionMsg, 'Unsupported', $option, $value)
                );
            }

            if (@mysqli_options($this->connection, $option, $value)) {
                continue;
            }

            $msg  = sprintf($exceptionMsg, 'Failed to set', $option, $value);
            $msg .= sprintf(', error: %s (%d)', mysqli_error($this->connection), mysqli_errno($this->connection));

            throw new MysqliException(
                $msg,
                $this->connection->sqlstate,
                $this->connection->errno
            );
        }
    }

    /**
     * Pings the server and re-connects when `mysqli.reconnect = 1`
     *
     * @return bool
     */
    public function ping()
    {
        return $this->connection->ping();
    }

    /**
     * Establish a secure connection
     *
     * @param mixed[] $params
     *
     * @throws MysqliException
     */
    private function setSecureConnection(array $params)
    {
        if (! isset($params['ssl_key']) &&
            ! isset($params['ssl_cert']) &&
            ! isset($params['ssl_ca']) &&
            ! isset($params['ssl_capath']) &&
            ! isset($params['ssl_cipher'])
        ) {
            return;
        }

        $this->connection->ssl_set(
            $params['ssl_key']    ?? null,
            $params['ssl_cert']   ?? null,
            $params['ssl_ca']     ?? null,
            $params['ssl_capath'] ?? null,
            $params['ssl_cipher'] ?? null
        );
    }
}
