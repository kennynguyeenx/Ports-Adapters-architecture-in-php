<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Ports\Incoming;

use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\AddUserCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\UserIdentifier;

/**
 * Interface AddNewUser
 * @package Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Ports\Incoming
 */
interface AddNewUser
{
    /**
     * @param AddUserCommand $addUserCommand
     * @return UserIdentifier
     */
    public function handle(AddUserCommand $addUserCommand): UserIdentifier;
}
