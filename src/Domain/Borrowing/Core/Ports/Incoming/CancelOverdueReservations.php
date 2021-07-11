<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Incoming;

/**
 * Interface CancelOverdueReservations
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Incoming
 */
interface CancelOverdueReservations
{
    public function cancelOverdueReservations(): void;
}
