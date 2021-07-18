<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing;

use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\NewBookWasAddedEvent;

/**
 * Interface InventoryEventPublisher
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing
 */
interface InventoryEventPublisher
{
    /**
     * @param NewBookWasAddedEvent $event
     */
    public function publishNewBookWasAddedEvent(NewBookWasAddedEvent $event): void;
}
