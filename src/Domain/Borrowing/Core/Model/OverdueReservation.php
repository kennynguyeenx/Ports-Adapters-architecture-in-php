<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model;

/**
 * Class OverdueReservation
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model
 */
class OverdueReservation
{
    /**
     * @var int
     */
    private $reservationId;
    /**
     * @var int
     */
    private $bookId;

    /**
     * OverdueReservation constructor.
     * @param int $reservationId
     * @param int $bookId
     */
    public function __construct(int $reservationId, int $bookId)
    {
        $this->reservationId = $reservationId;
        $this->bookId = $bookId;
    }

    /**
     * @return int
     */
    public function getReservationId(): int
    {
        return $this->reservationId;
    }

    /**
     * @return int
     */
    public function getBookId(): int
    {
        return $this->bookId;
    }
}
