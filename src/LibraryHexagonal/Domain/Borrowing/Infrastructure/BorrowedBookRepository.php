<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BorrowedBook;

/**
 * Interface BorrowedBookRepository
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure
 */
interface BorrowedBookRepository
{
    /**
     * @param BorrowedBook $borrowedBook
     * @return BorrowedBook
     */
    public function save(BorrowedBook $borrowedBook): BorrowedBook;

    /**
     * @param int $bookId
     * @return BorrowedBook|null
     */
    public function getByBookId(int $bookId): ?BorrowedBook;

    /**
     * @param int $bookId
     * @return void
     */
    public function deleteByBookId(int $bookId): void;

    /**
     * @param int $userId
     * @return BorrowedBook[]
     */
    public function findByUserId(int $userId): array;
}
