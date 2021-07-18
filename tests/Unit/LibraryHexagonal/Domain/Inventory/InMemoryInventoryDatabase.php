<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal\Domain\Inventory;

use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Book;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\InventoryDatabase;

/**
 * Class InMemoryInventoryDatabase
 * @package Tests\Unit\LibraryHexagonal\Domain\Inventory
 */
class InMemoryInventoryDatabase implements InventoryDatabase
{
    /**
     * @var Book[]
     */
    public $books = [];

    /**
     * @var int
     */
    private $id = 1;

    /**
     * @param Book $book
     * @return Book
     */
    public function save(Book $book): Book
    {
        $book->setId($this->id++);
        $this->books[$book->getId()] = $book;
        return $book;
    }
}
