<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure\Doctrine\DBAL\Driver\Mysqli;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Mysqli\Driver as MysqliDriver;
use Doctrine\DBAL\Driver\Mysqli\MysqliException;
use Exception;

/**
 * Class Driver
 * @package Coccoc\Component\Doctrine\DBAL\Driver\Mysqli
 */
class Driver extends MysqliDriver
{
    /**
     * @param array $params
     * @param null $username
     * @param null $password
     * @param array $driverOptions
     * @return MysqliConnection
     * @throws DBALException
     */
    public function connect(array $params, $username = null, $password = null, array $driverOptions = [])
    {
        if (!isset($params['username']) || !isset($params['password']) || !isset($params['database']) ||
            !isset($params['host'])
        ) {
            throw DBALException::driverException(
                $this,
                new Exception('Missing parameter for mysql cluster.')
            );
        }

        try {
            return new MysqliConnection($params, $username, $password, $driverOptions);
        } catch (MysqliException $e) {
            throw DBALException::driverException($this, $e);
        }
    }
}
