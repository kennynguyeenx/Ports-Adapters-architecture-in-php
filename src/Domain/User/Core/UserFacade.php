<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\User\Core;

use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\AddUserCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\User;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\UserIdentifier;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Ports\AddNewUser;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Ports\UserDatabase;

/**
 * Class UserFacade
 * @package Kennynguyeenx\LibraryHexagonal\Domain\User\Core
 */
class UserFacade implements AddNewUser
{
    /**
     * @var UserDatabase
     */
    private $userDatabase;

    /**
     * UserFacade constructor.
     * @param UserDatabase $userDatabase
     */
    public function __construct(UserDatabase $userDatabase)
    {
        $this->userDatabase = $userDatabase;
    }

    /**
     * @param AddUserCommand $addUserCommand
     * @return UserIdentifier
     */
    public function handle(AddUserCommand $addUserCommand): UserIdentifier
    {
        $user = new User(
            $addUserCommand->getEmail(),
            $addUserCommand->getFirstName(),
            $addUserCommand->getLastName()
        );

        return $this->userDatabase->save($user);
    }
}
