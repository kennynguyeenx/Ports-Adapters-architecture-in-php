<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure;

use DI\Container;
use Doctrine\ORM\EntityManager;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\User;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Ports\Incoming\AddNewUser;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Ports\Outgoing\UserDatabase;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\UserFacade;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Infrastructure\UserDatabaseAdapter;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Infrastructure\UserRepository;
use function DI\factory;

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
            UserRepository::class => factory(function (Container $c) {
                /** @var EntityManager $em */
                $em = $c->get('em');
                return $em->getRepository(User::class);
            }),
            UserDatabase::class => factory(function(Container $container) {
                return $container->make(UserDatabaseAdapter::class);
            }),
            AddNewUser::class => factory(function (Container $c) {
                return $c->make(UserFacade::class);
            }),
        ];
    }
}
