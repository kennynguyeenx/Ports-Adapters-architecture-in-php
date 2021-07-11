<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\User\Infrastructure;

use Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Model\User;
use Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Model\UserIdentifier;
use Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Ports\UserDatabase;

/**
 * Class UserDatabaseAdapter
 * @package Kennynguyeenx\PortsAndAdapters\Domain\User\Infrastructure
 */
class UserDatabaseAdapter implements UserDatabase
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserDatabaseAdapter constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $user
     * @return UserIdentifier
     */
    public function save(User $user): UserIdentifier
    {
        $savedUser = $this->userRepository->save($user);
        return new UserIdentifier($savedUser->getId());
    }
}
