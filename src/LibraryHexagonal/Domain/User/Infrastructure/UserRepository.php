<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\User\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\User;

/**
 * Interface UserRepository
 * @package Kennynguyeenx\LibraryHexagonal\Domain\User\Infrastructure
 */
interface UserRepository
{
    /**
     * @param User $user
     * @return User
     */
    public function save(User $user): User;

    /**
     * @param int $id
     * @return User|null
     */
    public function getById(int $id): ?User;
}
