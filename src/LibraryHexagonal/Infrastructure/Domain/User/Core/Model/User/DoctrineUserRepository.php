<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure\Domain\User\Core\Model\User;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
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
    protected string $aliasName = 'u';

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

    /**
     * @param int $id
     * @return User|null
     * @throws NonUniqueResultException
     */
    public function getById(int $id): ?User
    {
        return $this->createQueryBuilder($this->aliasName)
            ->where($this->aliasName . '.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
