<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Ports\UserDatabase;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Infrastructure\UserDatabaseAdapter;

/**
 * Class UserDomainConfig
 * @package Kennynguyeenx\LibraryHexagonal\Infrastructure
 */
class UserDomainConfig
{
    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return [
            UserDatabase::class => function(Application $application) {
                return $application->make(UserDatabaseAdapter::class);
            }
        ];
    }
}
