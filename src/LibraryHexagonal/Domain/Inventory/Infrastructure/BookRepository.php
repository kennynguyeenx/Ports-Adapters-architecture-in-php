<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Book;

/**
 * Class BookRepository
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Infrastructure
 */
class BookRepository
{
    /**
     * @param Book $book
     * @return Book
     */
    public function save(Book $book): Book
    {
        return $book;
    }
}
