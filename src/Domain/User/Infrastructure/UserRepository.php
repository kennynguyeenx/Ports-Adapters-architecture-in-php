<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\User\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\User;

/**
 * Class UserRepository
 * @package Kennynguyeenx\LibraryHexagonal\Domain\User\Infrastructure
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
