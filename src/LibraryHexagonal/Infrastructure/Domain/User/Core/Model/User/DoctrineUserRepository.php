<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure\Domain\User\Core\Model\User;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\User;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Infrastructure\UserRepository;

/**
 * Class DoctrineUserRepository
 * @package Kennynguyeenx\LibraryHexagonal\Infrastructure\Domain\User\Core\Model\User
 */
class DoctrineUserRepository extends EntityRepository implements UserRepository
{
    /**
     * @var string
     */
    protected $_aliasName = 'u';
    /**
     * @var string
     */
    protected $idColumn = '';

    /**
     * @param User $user
     * @return User
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(User $user): User
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush($user);
        return $user;
    }
}
