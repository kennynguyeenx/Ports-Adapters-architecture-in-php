<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\ReservedBook;

/**
 * Interface ReservedBookRepository
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure
 */
interface ReservedBookRepository
{
    /**
     * @param ReservedBook $reservedBook
     * @return ReservedBook
     */
    public function save(ReservedBook $reservedBook): ReservedBook;

    /**
     * @param int $bookId
     * @return ReservedBook|null
     */
    public function getByBookId(int $bookId): ?ReservedBook;

    /**
     * @param int $bookId
     * @return void
     */
    public function deleteByBookId(int $bookId): void;

    /**
     * @param int $userId
     * @return ReservedBook[]
     */
    public function findByUserId(int $userId): array;

    /**
     * @param array $condition
     * @return ReservedBook[]
     */
    public function getReservationByCondition(array $condition = []): array;
}
