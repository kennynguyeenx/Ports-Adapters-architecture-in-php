<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Application;

use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Incoming\CancelOverdueReservations;

/**
 * Class OverdueReservationScheduler
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Application
 */
class OverdueReservationScheduler
{
    /**
     * @var CancelOverdueReservations
     */
    private $cancelOverdueReservations;

    /**
     * OverdueReservationScheduler constructor.
     * @param CancelOverdueReservations $cancelOverdueReservations
     */
    public function __construct(CancelOverdueReservations $cancelOverdueReservations)
    {
        $this->cancelOverdueReservations = $cancelOverdueReservations;
    }

    /**
     * Run every minute
     */
    public function checkOverdueReservations()
    {
        $this->cancelOverdueReservations->cancelOverdueReservations();
    }
}
