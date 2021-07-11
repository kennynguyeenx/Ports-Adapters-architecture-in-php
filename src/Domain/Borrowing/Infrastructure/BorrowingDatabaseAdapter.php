<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Infrastructure;

use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\ActiveUser;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\AvailableBook;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\BorrowedBook;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\OverdueReservation;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\ReservationDetails;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\ReservationId;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\ReservedBook;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Outgoing\BorrowingDatabase;

/**
 * Class UserDatabaseAdapter
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Infrastructure
 */
class BorrowingDatabaseAdapter implements BorrowingDatabase
{
    /**
     * @param AvailableBook $availableBook
     */
    public function saveAvailableBook(AvailableBook $availableBook): void
    {
        // "INSERT INTO available (book_id) VALUES (?)", availableBook.getIdAsLong()
        // "DELETE FROM reserved WHERE book_id = ?", availableBook.getIdAsLong()
        // "DELETE FROM borrowed WHERE book_id = ?", availableBook.getIdAsLong()
    }

    /**
     * @param BorrowedBook $borrowedBook
     */
    public function saveBorrowedBook(BorrowedBook $borrowedBook): void
    {
        // INSERT INTO borrowed (book_id, user_id, borrowed_date) VALUES (?, ?, ?)
        // DELETE FROM reserved WHERE book_id = ?
        // DELETE FROM available WHERE book_id = ?
    }

    /**
     * @param ReservedBook $reservedBook
     * @return ReservationDetails
     */
    public function saveReservedBook(ReservedBook $reservedBook): ReservationDetails
    {
        // INSERT INTO reserved (book_id, user_id, reserved_date) VALUES (?, ?, ?)"
        // DELETE FROM available WHERE book_id = ?
        // SELECT id FROM reserved WHERE book_id = ?
        $reservationId = new ReservationId(1);
        return new ReservationDetails($reservationId, $reservedBook);
    }

    /**
     * @param int $bookId
     * @return AvailableBook|null
     */
    public function getAvailableBook(int $bookId): ?AvailableBook
    {
        // SELECT book_id FROM available WHERE book_id = ?
    }

    /**
     * @param int $userid
     * @return ActiveUser|null
     */
    public function getActiveUser(int $userId): ?ActiveUser
    {
        // SELECT id FROM public.library_user as u WHERE u.id = ?

        $reservedBooksByUser = $this->getReservedBooksByUser($userId);
        $borrowedBooksByUser = $this->getBorrowedBooksByUser($userId);
        return new ActiveUser($userId, $reservedBooksByUser, $borrowedBooksByUser);
    }

    /**
     * @param int $days
     * @return array
     */
    public function findReservationsForMoreThan(int $days): array
    {
        // SELECT id AS reservationId, book_id AS bookIdentification FROM reserved WHERE DATEADD(day, ?, reserved_date) > NOW()
        $dataFromDatabase = [];
        $overDueReservations = [];
        foreach ($dataFromDatabase as $item) {
            array_push(
                $overDueReservations,
                new OverdueReservation(
                    // getReservationId(),
                    // getBookIdentification()
                )
            );
        }

        return $overDueReservations;
    }

    /**
     * @param int $bookId
     * @return BorrowedBook|null
     */
    public function getBorrowedBook(int $bookId): ?BorrowedBook
    {
        // SELECT book_id, user_id, borrowed_date FROM borrowed WHERE book_id = ?
    }

    /**
     * @param int $bookId
     * @return ReservedBook|null
     */
    public function getReservedBook(int $bookId): ?ReservedBook
    {
        // SELECT book_id, user_id, reserved_date FROM reserved WHERE book_id = ?
    }

    /**
     * @param int $userId
     * @return array
     */
    private function getReservedBooksByUser(int $userId): array
    {
        // SELECT book_id, user_id, reserved_date FROM reserved WHERE user_id = ?
    }

    /**
     * @param int $userId
     * @return array
     */
    private function getBorrowedBooksByUser(int $userId): array
    {
        // SELECT book_id, user_id, borrowed_date FROM borrowed WHERE user_id = ?
    }
}
