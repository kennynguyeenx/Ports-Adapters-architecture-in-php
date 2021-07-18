<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Incoming;

use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BookReservationCommand;

/**
 * Interface ReserveBook
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Incoming
 */
interface ReserveBook
{
    /**
     * @param BookReservationCommand $bookReservationCommand
     * @return int
     */
    public function handleBookReservationCommand(BookReservationCommand $bookReservationCommand): int;
}
