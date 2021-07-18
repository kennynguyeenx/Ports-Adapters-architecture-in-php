<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BookReservedEvent;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Outgoing\BorrowingEventPublisher;

/**
 * Class KafkaBorrowingEventPublisherAdapter
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure
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
