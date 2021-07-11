<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model;

/**
 * Class ReservationDetails
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model
 */
class ReservationDetails
{
    /**
     * @var ReservationId
     */
    private $reservationId;
    /**
     * @var ReservedBook
     */
    private $reservedBook;

    /**
     * ReservationDetails constructor.
     * @param ReservationId $reservationId
     * @param ReservedBook $reservedBook
     */
    public function __construct(ReservationId $reservationId, ReservedBook $reservedBook)
    {
        $this->reservationId = $reservationId;
        $this->reservedBook = $reservedBook;
    }

    /**
     * @return ReservationId
     */
    public function getReservationId(): ReservationId
    {
        return $this->reservationId;
    }

    /**
     * @return ReservedBook
     */
    public function getReservedBook(): ReservedBook
    {
        return $this->reservedBook;
    }
}
