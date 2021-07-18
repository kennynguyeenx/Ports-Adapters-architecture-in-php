<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing;

use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Book;

/**
 * Interface GetBookDetails
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing
 */
interface GetBookDetails
{
    /**
     * @param string $bookId
     * @return Book
     */
    public function handle(string $bookId): Book;
}