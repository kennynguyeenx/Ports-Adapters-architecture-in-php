<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model;

use DateTime;

/**
 * Class BookReservedEvent
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model
 */
class BookReservedEvent
{
    /**
     * @var int
     */
    private $userId;
    /**
     * @var ReservedBook
     */
    private $reservedBook;
    /**
     * @var int
     */
    private $reservationId;
    /**
     * @var DateTime
     */
    private $timeStamp;

    /**
     * BookReservedEvent constructor.
     * @param ReservationDetails $reservationDetails
     */
    public function __construct(ReservationDetails $reservationDetails)
    {
        $this->userId = $reservationDetails->getReservedBook()->getUserId();
        $this->reservedBook = $reservationDetails->getReservedBook();
        $this->reservationId = $reservationDetails->getReservationId();
        $this->timeStamp = new DateTime();
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getBookId(): int
    {
        return $this->reservedBook->getId();
    }

    /**
     * @return int
     */
    public function getReservationId(): int
    {
        return $this->reservationId;
    }

    /**
     * @return string
     */
    public function getTimeStampAsString(): string
    {
        return $this->timeStamp->format('Y-m-d H:i:s');
    }
}
