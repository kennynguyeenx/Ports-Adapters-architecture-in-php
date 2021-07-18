<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal\Domain\Borrowing;

use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BookReservedEvent;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Outgoing\BorrowingEventPublisher;

/**
 * Class BorrowingEventPublisherFake
 * @package Tests\Unit\LibraryHexagonal\Domain\Borrowing
 */
class BorrowingEventPublisherFake implements BorrowingEventPublisher
{
    /**
     * @param BookReservedEvent $bookReservedEvent
     */
    public function publish(BookReservedEvent $bookReservedEvent): void
    {
        // TODO: Implement publish() method.
    }
}
