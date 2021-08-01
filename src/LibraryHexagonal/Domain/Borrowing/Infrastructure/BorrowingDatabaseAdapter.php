<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\ActiveUser;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\AvailableBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BorrowedBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\OverdueReservation;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\ReservationDetails;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\ReservationId;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\ReservedBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Outgoing\BorrowingDatabase;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Infrastructure\UserRepository;

/**
 * Class UserDatabaseAdapter
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure
 */
class BorrowingDatabaseAdapter implements BorrowingDatabase
{
    /**
     * @var AvailableBookRepository
     */
    private AvailableBookRepository $availableBookRepository;
    /**
     * @var ReservedBookRepository
     */
    private ReservedBookRepository $reservedBookRepository;
    /**
     * @var BorrowedBookRepository
     */
    private BorrowedBookRepository $borrowedBookRepository;
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * BorrowingDatabaseAdapter constructor.
     * @param AvailableBookRepository $availableBookRepository
     * @param ReservedBookRepository $reservedBookRepository
     * @param BorrowedBookRepository $borrowedBookRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        AvailableBookRepository $availableBookRepository,
        ReservedBookRepository $reservedBookRepository,
        BorrowedBookRepository $borrowedBookRepository,
        UserRepository $userRepository
    ) {
        $this->availableBookRepository = $availableBookRepository;
        $this->reservedBookRepository = $reservedBookRepository;
        $this->borrowedBookRepository = $borrowedBookRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param AvailableBook $availableBook
     */
    public function saveAvailableBook(AvailableBook $availableBook): void
    {
        $this->availableBookRepository->save($availableBook);
    }

    /**
     * @param int $bookId
     * @return AvailableBook|null
     */
    public function getAvailableBook(int $bookId): ?AvailableBook
    {
        return $this->availableBookRepository->getByBookId($bookId);
    }

    /**
     * @param BorrowedBook $borrowedBook
     */
    public function saveBorrowedBook(BorrowedBook $borrowedBook): void
    {
        $this->borrowedBookRepository->save($borrowedBook);
        $this->availableBookRepository->deleteByBookId($borrowedBook->getId());
        $this->reservedBookRepository->deleteByBookId($borrowedBook->getId());
    }

    /**
     * @param int $userId
     * @return ActiveUser|null
     */
    public function getActiveUser(int $userId): ?ActiveUser
    {
        if (empty($this->userRepository->getById($userId))) {
            return null;
        }

        $reservedBooksByUser = $this->getReservedBooksByUser($userId);
        $borrowedBooksByUser = $this->getBorrowedBooksByUser($userId);
        return new ActiveUser($userId, $reservedBooksByUser, $borrowedBooksByUser);
    }

    /**
     * @param ReservedBook $reservedBook
     * @return ReservationDetails
     */
    public function saveReservedBook(ReservedBook $reservedBook): ReservationDetails
    {
        $reservedBook = $this->reservedBookRepository->save($reservedBook);
        $this->availableBookRepository->deleteByBookId($reservedBook->getId());
        $reservationId = new ReservationId($reservedBook->getId());
        return new ReservationDetails($reservationId, $reservedBook);
    }

    /**
     * @param int $days
     * @return array
     */
    public function findReservationsForMoreThan(int $days): array
    {
        $listReservations = $this->reservedBookRepository->getReservationByCondition(
            ['reservedDate' => ['<' => date('Y-m-d', strtotime('-' . $days . ' days'))]]
        );

        $overDueReservations = [];
        foreach ($listReservations as $reservation) {
            array_push(
                $overDueReservations,
                new OverdueReservation(
                    $reservation->id,
                    $reservation->getId()
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
        return $this->borrowedBookRepository->getByBookId($bookId);
    }

    /**
     * @param int $bookId
     * @return ReservedBook|null
     */
    public function getReservedBook(int $bookId): ?ReservedBook
    {
        return $this->reservedBookRepository->getByBookId($bookId);
    }

    /**
     * @param int $userId
     * @return array
     */
    private function getReservedBooksByUser(int $userId): array
    {
        return $this->reservedBookRepository->findByUserId($userId);
    }

    /**
     * @param int $userId
     * @return array
     */
    private function getBorrowedBooksByUser(int $userId): array
    {
        return $this->borrowedBookRepository->findByUserId($userId);
    }
}
