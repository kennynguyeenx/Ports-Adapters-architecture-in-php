<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal\Domain\Inventory;

use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\InventoryFacade;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\AddNewBookCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\GetBookDetails;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\InventoryDatabase;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\InventoryEventPublisher;
use PHPUnit\Framework\TestCase;
use Tests\Unit\LibraryHexagonal\BookTestData;

/**
 * @coversDefaultClass \Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\InventoryFacade
 * Class InventoryFacadeTest
 * @package Tests\Unit\LibraryHexagonal\Domain\Inventory
 */
class InventoryFacadeTest extends TestCase
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
     * @var InventoryFacade
     */
    private $inventoryFacade;

    public function setUp(): void
    {
        parent::setUp();
        $this->database = new InMemoryInventoryDatabase();
        $this->getBookDetails = new GetBookDetailsFake();
        $this->eventPublisher = new InventoryEventPublisherFake();
        $this->inventoryFacade = new InventoryFacade($this->database, $this->getBookDetails, $this->eventPublisher);
    }

    /**
     * @test
     * @covers ::handle()
     */
    public function correctlySaveBook()
    {
        $addNewBookCommand = (new AddNewBookCommand())->setGoogleBookId(BookTestData::homoDeusBookGoogleId());

        //when
        $this->inventoryFacade->handle($addNewBookCommand);

        //then
        $actualBook = $this->database->books[1];
        $this->assertNotNull($actualBook);
    }
}
