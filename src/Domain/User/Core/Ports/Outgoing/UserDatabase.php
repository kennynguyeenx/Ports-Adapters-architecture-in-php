<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Ports;

use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\User;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\UserIdentifier;

/**
 * Interface UserDatabase
 * @package Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Ports
 */
interface UserDatabase
{
    /**
     * @param User $user
     * @return UserIdentifier
     */
    public function save(User $user): UserIdentifier;
}
