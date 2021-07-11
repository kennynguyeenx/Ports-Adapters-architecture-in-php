<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Incoming;

use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\BookReservationCommand;

/**
 * Interface ReserveBook
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Incoming
 */
interface ReserveBook
{
    /**
     * @param BookReservationCommand $bookReservationCommand
     * @return int
     */
    public function handleBookReservationCommand(BookReservationCommand $bookReservationCommand): int;
}
