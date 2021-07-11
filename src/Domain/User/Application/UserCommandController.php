<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\User\Application;

use Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Model\AddUserCommand;
use Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Ports\AddNewUser;

/**
 * Class UserCommandController
 * @package Kennynguyeenx\PortsAndAdapters\Domain\User\Application
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
     * @return mixed
     */
    public function addNewUser(AddUserCommand $addUserCommand)
    {
        $this->addNewUser->handle($addUserCommand);
        return new \HttpResponse("New user was added to library", HttpStatus.CREATED);
    }
}
