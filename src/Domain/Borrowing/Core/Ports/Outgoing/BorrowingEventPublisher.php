<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Outgoing;

use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\BookReservedEvent;

/**
 * Interface BorrowingEventPublisher
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Outgoing
 */
interface BorrowingEventPublisher
{
    /**
     * @param BookReservedEvent $bookReservedEvent
     */
    public function publish(BookReservedEvent $bookReservedEvent): void;
}
