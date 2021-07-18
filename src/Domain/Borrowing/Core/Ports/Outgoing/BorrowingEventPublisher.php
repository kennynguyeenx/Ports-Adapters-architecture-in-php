<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Outgoing;

use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BookReservedEvent;

/**
 * Interface BorrowingEventPublisher
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Outgoing
 */
interface BorrowingEventPublisher
{
    /**
     * @param BookReservedEvent $bookReservedEvent
     */
    public function publish(BookReservedEvent $bookReservedEvent): void;
}
