<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\User\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\User;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\UserIdentifier;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Ports\Outgoing\UserDatabase;

/**
 * Class UserDatabaseAdapter
 * @package Kennynguyeenx\LibraryHexagonal\Domain\User\Infrastructure
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
