<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing;

use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Book;

/**
 * Interface InventoryDatabase
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing
 */
interface InventoryDatabase
{
    /**
     * @param Book $book
     * @return Book
     */
    public function save(Book $book): Book;
}
