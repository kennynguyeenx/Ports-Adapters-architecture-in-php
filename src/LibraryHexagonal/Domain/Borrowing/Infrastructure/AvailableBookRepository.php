<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\AvailableBook;

/**
 * Interface AvailableBookRepository
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure
 */
interface AvailableBookRepository
{
    /**
     * @param AvailableBook $availableBook
     * @return AvailableBook
     */
    public function save(AvailableBook $availableBook): AvailableBook;

    /**
     * @param int $bookId
     * @return AvailableBook|null
     */
    public function getByBookId(int $bookId): ?AvailableBook;

    /**
     * @param int $bookId
     * @return void
     */
    public function deleteByBookId(int $bookId): void;
}
