<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core;

use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\AvailableBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BookReservationCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BookReservedEvent;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BorrowBookCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\Exception\ActiveUserNotFoundException;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\Exception\AvailableBookNotFoundException;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\Exception\BorrowedBookNotFoundException;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\Exception\ReservedBookNotFoundException;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\GiveBackBookCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\MakeBookAvailableCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Incoming\BorrowBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Incoming\CancelOverdueReservations;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Incoming\GiveBackBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Incoming\MakeBookAvailable;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Incoming\ReserveBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Outgoing\BorrowingDatabase;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Outgoing\BorrowingEventPublisher;

/**
 * Class BorrowingFacade
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core
 */
class BorrowingFacade implements BorrowBook, CancelOverdueReservations, MakeBookAvailable, ReserveBook, GiveBackBook
{
    /**
     * @var BorrowingDatabase
     */
    private $database;
    /**
     * @var BorrowingEventPublisher
     */
    private $eventPublisher;

    /**
     * BorrowingFacade constructor.
     * @param BorrowingDatabase $database
     * @param BorrowingEventPublisher $eventPublisher
     */
    public function __construct(BorrowingDatabase $database, BorrowingEventPublisher $eventPublisher)
    {
        $this->database = $database;
        $this->eventPublisher = $eventPublisher;
    }

    /**
     * @param MakeBookAvailableCommand $makeBookAvailableCommand
     */
    public function handleMakeBookAvailableCommand(MakeBookAvailableCommand $makeBookAvailableCommand): void
    {
        $this->database->saveAvailableBook(new AvailableBook($makeBookAvailableCommand->getBookId()));
    }

    /**
     * @param BookReservationCommand $bookReservationCommand
     * @return int
     * @throws AvailableBookNotFoundException
     * @throws ActiveUserNotFoundException
     * @throws Model\Exception\TooManyBooksAssignedToUserException
     */
    public function handleBookReservationCommand(BookReservationCommand $bookReservationCommand): int
    {
        $availableBook = $this->database->getAvailableBook($bookReservationCommand->getBookId());

        if (empty($availableBook)) {
            throw new AvailableBookNotFoundException($bookReservationCommand->getBookId());
        }

        $activeUser = $this->database->getActiveUser($bookReservationCommand->getUserId());

        if (empty($activeUser)) {
            throw new ActiveUserNotFoundException($bookReservationCommand->getUserId());
        }

        $reservedBook = $activeUser->reserve($availableBook);

        $reservationDetails = $this->database->saveReservedBook($reservedBook);

        $this->eventPublisher->publish(new BookReservedEvent($reservationDetails));

        return $reservationDetails->getReservationId()->getId();
    }

    public function cancelOverdueReservations(): void
    {
        $overdueReservationList = $this->database->findReservationsForMoreThan(3);
        foreach ($overdueReservationList as $overdueBook) {
            $this->database->saveAvailableBook(new AvailableBook($overdueBook->getBookId()));
        }
    }

    /**
     * @param BorrowBookCommand $borrowBookCommand
     * @throws ActiveUserNotFoundException
     * @throws ReservedBookNotFoundException
     * @throws Model\Exception\TooManyBooksAssignedToUserException
     */
    public function handleBorrowBookCommand(BorrowBookCommand $borrowBookCommand): void
    {
        $activeUser = $this->database->getActiveUser($borrowBookCommand->getUserId());

        if (empty($activeUser)) {
            throw new ActiveUserNotFoundException($borrowBookCommand->getUserId());
        }

        $reservedBook = $this->database->getReservedBook($borrowBookCommand->getBookId());

        if (empty($reservedBook)) {
            throw new ReservedBookNotFoundException($borrowBookCommand->getBookId());
        }

        $borrowedBook = $activeUser->borrow($reservedBook);
        $this->database->saveBorrowedBook($borrowedBook);
    }

    /**
     * @param GiveBackBookCommand $giveBackBookCommand
     * @throws BorrowedBookNotFoundException
     * @throws ActiveUserNotFoundException
     */
    public function handleGiveBackBookCommand(GiveBackBookCommand $giveBackBookCommand): void
    {
        $borrowedBook = $this->database->getBorrowedBook($giveBackBookCommand->getBookId());

        if (empty($borrowedBook)) {
            throw new BorrowedBookNotFoundException($giveBackBookCommand->getBookId());
        }

        $activeUser = $this->database->getActiveUser($giveBackBookCommand->getUserId());

        if (empty($activeUser)) {
            throw new ActiveUserNotFoundException($giveBackBookCommand->getUserId());
        }

        $availableBook = $activeUser->giveBack($borrowedBook);
        $this->database->saveAvailableBook($availableBook);
    }
}
