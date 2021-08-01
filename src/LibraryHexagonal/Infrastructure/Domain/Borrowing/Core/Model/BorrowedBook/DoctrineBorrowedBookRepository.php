<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure\Domain\Borrowing\Core\Model\BorrowedBook;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BorrowedBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure\BorrowedBookRepository;

/**
 * Class DoctrineBorrowedBookRepository
 * @package Kennynguyeenx\LibraryHexagonal\Infrastructure\Domain\Borrowing\Core\Model\BorrowedBook
 */
class DoctrineBorrowedBookRepository extends EntityRepository implements BorrowedBookRepository
{
    /**
     * @var string
     */
    protected string $aliasName = 'b_b';

    /**
     * @param BorrowedBook $borrowedBook
     * @return BorrowedBook
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(BorrowedBook $borrowedBook): BorrowedBook
    {
        $this->getEntityManager()->persist($borrowedBook);
        $this->getEntityManager()->flush($borrowedBook);
        return $borrowedBook;
    }

    /**
     * @param int $bookId
     * @return BorrowedBook|null
     * @throws NonUniqueResultException
     */
    public function getByBookId(int $bookId): ?BorrowedBook
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
     * @return BorrowedBook[]
     */
    public function findByUserId(int $userId): array
    {
        return $this->createQueryBuilder($this->aliasName)
            ->where($this->aliasName . '.userId = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getArrayResult();
    }
}
