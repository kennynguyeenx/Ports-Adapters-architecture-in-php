<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal\Domain\Borrowing;

use Exception;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\ActiveUser;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\AvailableBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BorrowedBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\OverdueReservation;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\ReservationDetails;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\ReservationId;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\ReservedBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Outgoing\BorrowingDatabase;

/**
 * Class InMemoryBorrowingDatabase
 * @package Tests\Unit\LibraryHexagonal\Domain\Borrowing
 */
class InMemoryBorrowingDatabase implements BorrowingDatabase
{
    /**
     * @var ActiveUser[]
     */
    public $activeUsers = [];
    /**
     * @var AvailableBook[]
     */
    public $availableBooks = [];
    /**
     * @var ReservedBook[]
     */
    public $reservedBooks = [];
    /**
     * @var BorrowedBook[]
     */
    public $borrowedBooks = [];

    /**
     * @param AvailableBook $availableBook
     */
    public function saveAvailableBook(AvailableBook $availableBook): void
    {
        $this->availableBooks[$availableBook->getId()] = $availableBook;
        unset($this->reservedBooks[$availableBook->getId()]);
        unset($this->borrowedBooks[$availableBook->getId()]);
    }

    /**
     * @param int $bookId
     * @return AvailableBook|null
     */
    public function getAvailableBook(int $bookId): ?AvailableBook
    {
        return $this->availableBooks[$bookId] ?? null;
    }

    /**
     * @param int $userId
     * @return ActiveUser|null
     */
    public function getActiveUser(int $userId): ?ActiveUser
    {
        return $this->activeUsers[$userId] ?? null;
    }

    /**
     * @param ReservedBook $reservedBook
     * @return ReservationDetails
     * @throws Exception
     */
    public function saveReservedBook(ReservedBook $reservedBook): ReservationDetails
    {
        $reservationId = random_int(1, 10);
        unset($this->availableBooks[$reservedBook->getId()]);
        $this->reservedBooks[$reservedBook->getId()] = $reservedBook;
        return new ReservationDetails(new ReservationId($reservationId), $reservedBook);
    }

    /**
     * @param BorrowedBook $borrowedBook
     */
    public function saveBorrowedBook(BorrowedBook $borrowedBook): void
    {
        unset($this->reservedBooks[$borrowedBook->getId()]);
        $this->borrowedBooks[$borrowedBook->getId()] = $borrowedBook;
    }

    /**
     * @param int $days
     * @return OverdueReservation[]
     */
    public function findReservationsForMoreThan(int $days): array
    {
        $threeDaysAgo = date('Y-m-d', strtotime('-3 days'));
        $overdueReservationList = [];

        foreach ($this->reservedBooks as $reservedBook) {
            if ($reservedBook->getReservedDate()->format('Y-m-d') < $threeDaysAgo) {
                array_push(
                    $overdueReservationList,
                    new OverdueReservation(1, $reservedBook->getId())
                );
            }
        }

        return $overdueReservationList;
    }

    /**
     * @param int $bookId
     * @return ReservedBook|null
     */
    public function getReservedBook(int $bookId): ?ReservedBook
    {
        return $this->reservedBooks[$bookId] ?? null;
    }

    /**
     * @param int $bookId
     * @return BorrowedBook|null
     */
    public function getBorrowedBook(int $bookId): ?BorrowedBook
    {
        return $this->borrowedBooks[$bookId] ?? null;
    }
}
