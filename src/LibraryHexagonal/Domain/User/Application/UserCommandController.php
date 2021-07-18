<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\User\Application;

use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\AddUserCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Ports\Incoming\AddNewUser;

/**
 * Class UserCommandController
 * @package Kennynguyeenx\LibraryHexagonal\Domain\User\Application
 */
class UserCommandController
{
    /**
     * @var AddNewUser
     */
    private $addNewUser;

    /**
     * UserCommandController constructor.
     * @param AddNewUser $addNewUser
     */
    public function __construct(AddNewUser $addNewUser)
    {
        $this->addNewUser = $addNewUser;
    }

    /**
     * @param AddUserCommand $addUserCommand
     * @return void
     */
    public function addNewUser(AddUserCommand $addUserCommand): void
    {
        $this->addNewUser->handle($addUserCommand);
    }
}
