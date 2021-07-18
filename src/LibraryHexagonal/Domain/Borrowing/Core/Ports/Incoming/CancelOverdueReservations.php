<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Incoming;

/**
 * Interface CancelOverdueReservations
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Incoming
 */
interface CancelOverdueReservations
{
    public function cancelOverdueReservations(): void;
}
