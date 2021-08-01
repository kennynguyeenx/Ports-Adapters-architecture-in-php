<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure\Domain\Borrowing\Core\Model\AvailableBook;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\AvailableBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure\AvailableBookRepository;

/**
 * Class DoctrineAvailableBookRepository
 * @package Kennynguyeenx\LibraryHexagonal\Infrastructure\Domain\Borrowing\Core\Model\AvailableBook
 */
class DoctrineAvailableBookRepository extends EntityRepository implements AvailableBookRepository
{
    /**
     * @var string
     */
    protected string $aliasName = 'a_b';

    /**
     * @param AvailableBook $availableBook
     * @return AvailableBook
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(AvailableBook $availableBook): AvailableBook
    {
        $this->getEntityManager()->persist($availableBook);
        $this->getEntityManager()->flush($availableBook);
        return $availableBook;
    }

    /**
     * @param int $bookId
     * @return AvailableBook|null
     * @throws NonUniqueResultException
     */
    public function getByBookId(int $bookId): ?AvailableBook
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
}
