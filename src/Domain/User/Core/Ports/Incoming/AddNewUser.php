<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Ports;

use Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Model\AddUserCommand;
use Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Model\UserIdentifier;

/**
 * Interface AddNewUser
 * @package Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Ports
 */
interface AddNewUser
{
    /**
     * @param AddUserCommand $addUserCommand
     * @return UserIdentifier
     */
    public function handle(AddUserCommand $addUserCommand): UserIdentifier;
}
