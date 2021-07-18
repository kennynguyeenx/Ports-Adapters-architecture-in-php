<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\NewBookWasAddedEvent;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\InventoryEventPublisher;

/**
 * Class KafkaBorrowingEventPublisherAdapter
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Infrastructure
 */
class KafkaInventoryEventPublisherAdapter implements InventoryEventPublisher
{
    /**
     * @param NewBookWasAddedEvent $event
     */
    public function publishNewBookWasAddedEvent(NewBookWasAddedEvent $event): void
    {
        // KafkaProducer.publish($event);
    }
}
