<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure\Domain\Borrowing\Core\Model\ReservedBook;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\ReservedBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure\ReservedBookRepository;

/**
 * Class DoctrineReservedBookRepository
 * @package Kennynguyeenx\LibraryHexagonal\Infrastructure\Domain\Borrowing\Core\Model\ReservedBook
 */
class DoctrineReservedBookRepository extends EntityRepository implements ReservedBookRepository
{
    /**
     * @var string
     */
    protected string $aliasName = 'r_b';

    /**
     * @param ReservedBook $reservedBook
     * @return ReservedBook
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(ReservedBook $reservedBook): ReservedBook
    {
        $this->getEntityManager()->persist($reservedBook);
        $this->getEntityManager()->flush($reservedBook);
        return $reservedBook;
    }

    /**
     * @param int $bookId
     * @return ReservedBook|null
     * @throws NonUniqueResultException
     */
    public function getByBookId(int $bookId): ?ReservedBook
    {
        return $this->createQueryBuilder($this->aliasName)
            ->where($this->aliasName . '.bookId = :bookId')
            ->setParameter('bookId', $bookId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param int $bookId
     */
    public function deleteByBookId(int $bookId): void
    {
        $this->createQueryBuilder($this->aliasName)
            ->delete()
            ->where($this->aliasName . '.bookId = :bookId')
            ->setParameter('bookId', $bookId)
            ->getQuery()
            ->execute();
    }

    /**
     * @param int $userId
     * @return ReservedBook[]
     */
    public function findByUserId(int $userId): array
    {
        return $this->createQueryBuilder($this->aliasName)
            ->where($this->aliasName . '.userId = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param array $condition
     * @return array
     */
    public function getReservationByCondition(array $condition = []): array
    {
        $query = $this->createQueryBuilder($this->aliasName);

        if (! empty($condition['reservedDate']['<'])) {
            $query->where($this->aliasName . '.reservedDate < :date')
                ->setParameter('date', $condition['reservedDate']['<']);
        }

        return $query->getQuery()->getArrayResult();
    }
}
