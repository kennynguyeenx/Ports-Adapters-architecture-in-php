<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal\Domain\Inventory;

use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\NewBookWasAddedEvent;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\InventoryEventPublisher;

/**
 * Class InventoryEventPublisherFake
 * @package Tests\Unit\LibraryHexagonal\Domain\Inventory
 */
class InventoryEventPublisherFake implements InventoryEventPublisher
{
    /**
     * @param NewBookWasAddedEvent $event
     */
    public function publishNewBookWasAddedEvent(NewBookWasAddedEvent $event): void
    {
        // TODO: Implement publishNewBookWasAddedEvent() method.
    }
}
