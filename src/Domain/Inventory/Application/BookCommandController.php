<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Application;

use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\AddNewBookCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Incoming\AddNewBook;

/**
 * Class BookCommandController
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Application
 */
class BookCommandController
{
    /**
     * @var AddNewBook
     */
    private $addNewBook;

    /**
     * BookCommandController constructor.
     * @param AddNewBook $addNewBook
     */
    public function __construct(AddNewBook $addNewBook)
    {
        $this->addNewBook = $addNewBook;
    }

    /**
     * @param AddNewBookCommand $addNewBookCommand
     * @return mixed
     */
    public function addNewBook(AddNewBookCommand $addNewBookCommand): \HttpResponse
    {
        $this->addNewBook->handle($addNewBookCommand);
        return new \HttpResponse("New user was added to library", HttpStatus.CREATED);
    }
}
