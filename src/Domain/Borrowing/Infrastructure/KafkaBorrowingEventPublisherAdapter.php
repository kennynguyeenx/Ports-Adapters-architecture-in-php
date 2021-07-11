<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Infrastructure;

use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\BookReservedEvent;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Outgoing\BorrowingEventPublisher;

/**
 * Class KafkaBorrowingEventPublisherAdapter
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Infrastructure
 */
class KafkaBorrowingEventPublisherAdapter implements BorrowingEventPublisher
{
    /**
     * @param BookReservedEvent $bookReservedEvent
     */
    public function publish(BookReservedEvent $bookReservedEvent): void
    {
        // KafkaProducer.publish($event);
    }
}
