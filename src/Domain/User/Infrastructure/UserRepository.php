<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\User\Infrastructure;

use Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Model\User;

/**
 * Class UserRepository
 * @package Kennynguyeenx\PortsAndAdapters\Domain\User\Infrastructure
 */
class UserRepository
{
    /**
     * @param User $user
     * @return User
     */
    public function save(User $user): User
    {
        return $user;
    }
}
