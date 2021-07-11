<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Application;

use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Application\Model\BookStatus;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Application\Model\ChangeBookStatusRequest;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\BookReservationCommand;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\BorrowBookCommand;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\GiveBackBookCommand;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Incoming\BorrowBook;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Incoming\GiveBackBook;
use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Incoming\ReserveBook;

/**
 * Class BorrowingDomainController
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Application
 */
class BorrowingDomainController
{
    /**
     * @var GiveBackBook
     */
    private $giveBackBook;
    /**
     * @var BorrowBook
     */
    private $borrowBook;
    /**
     * @var ReserveBook
     */
    private $reserveBook;

    /**
     * BorrowingDomainController constructor.
     * @param GiveBackBook $giveBackBook
     * @param BorrowBook $borrowBook
     * @param ReserveBook $reserveBook
     */
    public function __construct(GiveBackBook $giveBackBook, BorrowBook $borrowBook, ReserveBook $reserveBook)
    {
        $this->giveBackBook = $giveBackBook;
        $this->borrowBook = $borrowBook;
        $this->reserveBook = $reserveBook;
    }

    /**
     * @param int $bookId
     * @param ChangeBookStatusRequest $request
     * @return mixed
     */
    public function borrowBook(int $bookId, ChangeBookStatusRequest $request)
    {
        switch ($request->getBookStatus()->getStatus()){
            case BookStatus::AVAILABLE:
                $this->giveBackBook->handleGiveBackBookCommand(
                    new GiveBackBookCommand($bookId, $request->getUserId())
                );
                return new \HttpResponse("Book with an id " . $bookId . " was returned", 200);
            case BookStatus::RESERVED:
                $reservationId = $this->reserveBook->handleBookReservationCommand(
                    new BookReservationCommand($bookId, $request->getUserId())
                );
                return new \HttpResponse("Reservation has been made with an id " . $reservationId, 200);
            case BookStatus::BORROWED:
                $this->borrowBook->handleBorrowBookCommand(
                    new BorrowBookCommand($bookId, $request->getUserId())
                );
                return new \HttpResponse("Book with an id " . $bookId . " was borrowed", 200);
            default:
                return new \HttpResponse("Book can't have status: " . request.getStatus(), 400);
        }
    }
}
