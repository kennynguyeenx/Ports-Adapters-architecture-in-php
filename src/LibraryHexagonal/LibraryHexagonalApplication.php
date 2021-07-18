<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal;

use DI\Bridge\Slim\Bridge;
use DI\Container;
use DI\ContainerBuilder;
use Doctrine\DBAL\Driver\Mysqli\Driver;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;
use Exception;
use Kennynguyeenx\LibraryHexagonal\Infrastructure\BorrowingDomainConfig;
use Kennynguyeenx\LibraryHexagonal\Infrastructure\EmailDomainConfig;
use Kennynguyeenx\LibraryHexagonal\Infrastructure\InventoryDomainConfig;
use Kennynguyeenx\LibraryHexagonal\Infrastructure\LibraryHexagonalConfig;
use Kennynguyeenx\LibraryHexagonal\Infrastructure\UserDomainConfig;
use Slim\App;

/**
 * Class LibraryHexagonalApplication
 * @package Kennynguyeenx\LibraryHexagonal
 */
class LibraryHexagonalApplication
{
    /**
     * @return App
     * @throws ORMException
     */
    public static function createApp(): App
    {
        return Bridge::create(self::configureContainer());
    }

    /**
     * @return Container
     * @throws ORMException
     * @throws Exception
     */
    private static function configureContainer(): Container
    {
        $builder = new ContainerBuilder();
        $settings = self::initSetting();
        $entityManager = self::initDoctrine();
        $builder->addDefinitions(['em' => $entityManager]);
        $builder->addDefinitions($settings);
        $builder->addDefinitions(LibraryHexagonalConfig::getConfig());
        $builder->addDefinitions(BorrowingDomainConfig::getConfig());
        $builder->addDefinitions(EmailDomainConfig::getConfig());
        $builder->addDefinitions(InventoryDomainConfig::getConfig());
        $builder->addDefinitions(UserDomainConfig::getConfig());
        return $builder->build();
    }

    /**
     * @return array
     */
    private static function initSetting(): array
    {
        return require ROOT_FOLDER . 'configs/settings.php';
    }

    /**
     * @return EntityManager
     * @throws ORMException
     */
    private static function initDoctrine(): EntityManager
    {
        $paths = [ROOT_FOLDER . 'src/LibraryHexagonal/Infrastructure/Persistence/Doctrine/Mapping'];
        $setting = require ROOT_FOLDER . 'configs/settings.php';
        $config = $setting['config'];

        // database configuration parameters
        $dbParams = [
            'driverClass'   => Driver::class,
            'username'      => $config['doctrine']['mysql']['username'],
            'password'      => $config['doctrine']['mysql']['password'],
            'host'          => $config['doctrine']['mysql']['host'],
            'database'      => $config['doctrine']['mysql']['database'],
            'charset'       => $config['doctrine']['mysql']['charset'],
        ];

        $proxiesDir = $config['doctrine']['proxy']['path'];
        $config = Setup::createYAMLMetadataConfiguration($paths, false, $proxiesDir);
        return EntityManager::create($dbParams, $config);
    }
}
