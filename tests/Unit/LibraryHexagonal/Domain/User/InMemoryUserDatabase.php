<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal\Domain\User;

use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\User;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\UserIdentifier;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Ports\Outgoing\UserDatabase;

/**
 * Class InMemoryUserDatabase
 * @package Tests\Unit\LibraryHexagonal\Domain\User
 */
class InMemoryUserDatabase implements UserDatabase
{
    /**
     * @var User[]
     */
    public $users = [];

    /**
     * @var int
     */
    private $id = 1;

    /**
     * @param User $user
     * @return UserIdentifier
     */
    public function save(User $user): UserIdentifier
    {
        $user->setId($this->id++);
        $this->users[$user->getId()] = $user;
        return new UserIdentifier($user->getId());
    }
}
