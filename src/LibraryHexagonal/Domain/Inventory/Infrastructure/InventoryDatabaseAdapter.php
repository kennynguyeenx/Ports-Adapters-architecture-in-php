<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Book;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\InventoryDatabase;

/**
 * Class InventoryDatabaseAdapter
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Infrastructure
 */
class InventoryDatabaseAdapter implements InventoryDatabase
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * InventoryDatabaseAdapter constructor.
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @param Book $book
     * @return Book
     */
    public function save(Book $book): Book
    {
        return $this->bookRepository->save($book);
    }
}
