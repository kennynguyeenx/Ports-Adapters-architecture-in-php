<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core;

use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\AddNewBookCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\NewBookWasAddedEvent;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Incoming\AddNewBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\GetBookDetails;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\InventoryDatabase;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\InventoryEventPublisher;

/**
 * Class InventoryFacade
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core
 */
class InventoryFacade implements AddNewBook
{
    /**
     * @var InventoryDatabase
     */
    private $database;
    /**
     * @var GetBookDetails
     */
    private $getBookDetails;
    /**
     * @var InventoryEventPublisher
     */
    private $eventPublisher;

    /**
     * InventoryFacade constructor.
     * @param InventoryDatabase $database
     * @param GetBookDetails $getBookDetails
     * @param InventoryEventPublisher $eventPublisher
     */
    public function __construct(
        InventoryDatabase $database,
        GetBookDetails $getBookDetails,
        InventoryEventPublisher $eventPublisher
    )
    {
        $this->database = $database;
        $this->getBookDetails = $getBookDetails;
        $this->eventPublisher = $eventPublisher;
    }

    /**
     * @param AddNewBookCommand $addNewBookCommand
     */
    public function handle(AddNewBookCommand $addNewBookCommand): void
    {
        $book = $this->getBookDetails->handle($addNewBookCommand->getGoogleBookId());
        $savedBook = $this->database->save($book);
        $this->eventPublisher->publishNewBookWasAddedEvent(new NewBookWasAddedEvent($savedBook->getId()));
    }
}
