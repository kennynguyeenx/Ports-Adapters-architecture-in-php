<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Outgoing;

use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\ActiveUser;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\AvailableBook;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\BorrowedBook;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\OverdueReservation;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\ReservationDetails;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\ReservedBook;

/**
 * Interface BorrowingDatabase
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Outgoing
 */
interface BorrowingDatabase
{
    /**
     * @param AvailableBook $availableBook
     */
    public function saveAvailableBook(AvailableBook $availableBook): void;

    /**
     * @param ReservedBook $reservedBook
     * @return ReservationDetails
     */
    public function saveReservedBook(ReservedBook $reservedBook): ReservationDetails;

    /**
     * @param BorrowedBook $borrowedBook
     */
    public function saveBorrowedBook(BorrowedBook $borrowedBook): void;

    /**
     * @param int $bookId
     * @return AvailableBook|null
     */
    public function getAvailableBook(int $bookId): ?AvailableBook;

    /**
     * @param int $userId
     * @return ActiveUser|null
     */
    public function getActiveUser(int $userId): ?ActiveUser;

    /**
     * @param int $days
     * @return array|OverdueReservation[]
     */
    public function findReservationsForMoreThan(int $days): array;

    /**
     * @param int $bookId
     * @return ReservedBook|null
     */
    public function getReservedBook(int $bookId): ?ReservedBook;

    /**
     * @param int $bookId
     * @return BorrowedBook|null
     */
    public function getBorrowedBook(int $bookId): ?BorrowedBook;
}
