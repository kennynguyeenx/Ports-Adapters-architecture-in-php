<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Ports;

use Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Model\User;
use Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Model\UserIdentifier;

/**
 * Interface UserDatabase
 * @package Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Ports
 */
interface UserDatabase
{
    /**
     * @param User $user
     * @return UserIdentifier
     */
    public function save(User $user): UserIdentifier;
}
