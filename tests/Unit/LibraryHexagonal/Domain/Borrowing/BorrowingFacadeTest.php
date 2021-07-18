<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal\Domain\Borrowing;

use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\BorrowingFacade;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\AvailableBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\Exception\ActiveUserNotFoundException;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\Exception\AvailableBookNotFoundException;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\Exception\TooManyBooksAssignedToUserException;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\MakeBookAvailableCommand;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\BorrowingFacade
 * Class BorrowingFacadeTest
 * @package Tests\Unit\LibraryHexagonal\Domain\Borrowing
 */
class BorrowingFacadeTest extends TestCase
{
    /**
     * @var InMemoryBorrowingDatabase
     */
    private $database;
    /**
     * @var BorrowingEventPublisherFake
     */
    private $eventPublisher;
    /**
     * @var BorrowingFacade
     */
    private $borrowingFacade;

    public function setUp(): void
    {
        parent::setUp();
        $this->database = new InMemoryBorrowingDatabase();
        $this->eventPublisher = new BorrowingEventPublisherFake();
        $this->borrowingFacade = new BorrowingFacade($this->database, $this->eventPublisher);
    }

    /**
     * @test
     * @covers ::handleMakeBookAvailableCommand()
     */
    public function whenMakeBookAvailableCommandReceived_thenBookIsOnAvailableStatus()
    {
        //given
        $makeBookAvailableCommand = (new MakeBookAvailableCommand())->setBookId(100);

        //when
        $this->borrowingFacade->handleMakeBookAvailableCommand($makeBookAvailableCommand);

        //then
        $this->assertTrue(isset($this->database->availableBooks[100]));
        $this->assertEquals(new AvailableBook(100), $this->database->availableBooks[100]);
    }

    /**
     * @test
     * @covers ::handleBookReservationCommand()
     */
    public function givenAvailableBooksAndActiveUser_whenMakingReservation_thenBookIsReserved()
    {
        //given
        $reservationCommand = ReservationTestData::anyBookReservationCommand(100, 100);
        $availableBook = ReservationTestData::anyAvailableBook($reservationCommand->getBookId());
        $activeUser = ReservationTestData::anyActiveUser($reservationCommand->getUserId());

        $this->database->activeUsers[$activeUser->getId()] = $activeUser;
        $this->database->availableBooks[$availableBook->getId()] = $availableBook;

        //when
        $this->borrowingFacade->handleBookReservationCommand($reservationCommand);

        //then
        $this->assertCount(1, $activeUser->getReservedBooks());
        $this->assertEquals($availableBook->getId(), array_values($activeUser->getReservedBooks())[0]->getId());
    }

    /**
     * @test
     * @covers ::handleBookReservationCommand()
     */
    public function givenActiveUserAlreadyHas3Books_whenMakingReservation_thenBookIsNotReserved()
    {
        //given
        $firstReservationCommand = ReservationTestData::anyBookReservationCommand(100, 100);
        $secondReservationCommand = ReservationTestData::anyBookReservationCommand(101, 100);
        $thirdReservationCommand = ReservationTestData::anyBookReservationCommand(102, 100);
        $fourthReservationCommand = ReservationTestData::anyBookReservationCommand(103, 100);

        $availableBookNo1 = ReservationTestData::anyAvailableBook($firstReservationCommand->getBookId());
        $availableBookNo2 = ReservationTestData::anyAvailableBook($secondReservationCommand->getBookId());
        $availableBookNo3 = ReservationTestData::anyAvailableBook($thirdReservationCommand->getBookId());
        $availableBookNo4 = ReservationTestData::anyAvailableBook($fourthReservationCommand->getBookId());

        $activeUser = ReservationTestData::anyActiveUser($firstReservationCommand->getUserId());

        $this->database->availableBooks[$availableBookNo1->getId()] = $availableBookNo1;
        $this->database->availableBooks[$availableBookNo2->getId()] = $availableBookNo2;
        $this->database->availableBooks[$availableBookNo3->getId()] = $availableBookNo3;
        $this->database->availableBooks[$availableBookNo4->getId()] = $availableBookNo4;
        $this->database->activeUsers[$activeUser->getId()] = $activeUser;

        $this->borrowingFacade->handleBookReservationCommand($firstReservationCommand);
        $this->borrowingFacade->handleBookReservationCommand($secondReservationCommand);
        $this->borrowingFacade->handleBookReservationCommand($thirdReservationCommand);

        $this->expectException(TooManyBooksAssignedToUserException::class);
        $this->expectExceptionMessage(
            "You can't assign another book to user account: 100. Reason: Too many books already assigned."
        );
        //when & then
        $this->borrowingFacade->handleBookReservationCommand($fourthReservationCommand);
    }

    /**
     * @test
     * @covers ::handleBookReservationCommand()
     */
    public function givenNotAvailableBook_whenMakingReservation_thenThrowException()
    {
        //given
        $reservationCommand = ReservationTestData::anyBookReservationCommand(100, 100);
        $activeUser = ReservationTestData::anyActiveUser($reservationCommand->getUserId());

        $this->database->activeUsers[$activeUser->getId()] = $activeUser;

        $this->expectException(AvailableBookNotFoundException::class);
        $this->expectExceptionMessage("There is no available book with an ID: 100");
        $this->borrowingFacade->handleBookReservationCommand($reservationCommand);
    }

    /**
     * @test
     * @covers ::handleBookReservationCommand()
     */
    public function givenNotActiveUser_whenMakingReservation_thenThrowException()
    {
        //given
        $reservationCommand = ReservationTestData::anyBookReservationCommand(100, 100);
        $availableBook = ReservationTestData::anyAvailableBook($reservationCommand->getBookId());

        $this->database->availableBooks[$availableBook->getId()] = $availableBook;

        $this->expectException(ActiveUserNotFoundException::class);
        $this->expectExceptionMessage("There is no active user with an ID: 100");
        $this->borrowingFacade->handleBookReservationCommand($reservationCommand);
    }

    /**
     * @test
     * @covers ::cancelOverdueReservations()
     */
    public function givenBookIsReserved_when3daysPass_thenBookIsAvailable()
    {
        //given
        $reservedBook = ReservationTestData::getReservedBookWithCustomDate(100, 100, 4);
        $this->database->reservedBooks[100] = $reservedBook;

        //when
        $this->borrowingFacade->cancelOverdueReservations();

        //then
        $this->assertCount(0, $this->database->reservedBooks);
    }

    /**
     * @test
     * @covers ::cancelOverdueReservations()
     */
    public function givenBookIsReserved_when2daysPass_thenBookIsStillReserved()
    {
        //given
        $reservedBook = ReservationTestData::getReservedBookWithCustomDate(100, 100, 2);
        $this->database->reservedBooks[100] = $reservedBook;

        //when
        $this->borrowingFacade->cancelOverdueReservations();

        //then
        $this->assertCount(1, $this->database->reservedBooks);
    }

    /**
     * @test
     * @covers ::handleBorrowBookCommand()
     */
    public function givenReservedBookAndActiveUser_whenBorrowing_thenBookIsBorrowed()
    {
        //given
        $borrowBookCommand = BorrowTestData::anyBorrowBookCommand(100, 100);
        $reservedBook = BorrowTestData::anyReservedBook(
            $borrowBookCommand->getBookId(),
            $borrowBookCommand->getUserId()
        );
        $activeUser = BorrowTestData::anyActiveUser($borrowBookCommand->getUserId());

        $this->database->activeUsers[$activeUser->getId()] = $activeUser;
        $this->database->reservedBooks[$reservedBook->getId()] = $reservedBook;

        //when
        $this->borrowingFacade->handleBorrowBookCommand($borrowBookCommand);

        //then
        $this->assertCount(1, $activeUser->getBorrowedBooks());
    }

    /**
     * @test
     * @covers ::handleBorrowBookCommand()
     */
    public function givenUserWithBorrowedBook_whenBookIsReturned_thenBookIsAvailable()
    {
        //given
        $giveBackBookCommand = BorrowTestData::anyGiveBookCommand(100, 100);
        $borrowedBook = BorrowTestData::anyBorrowedBook(
            $giveBackBookCommand->getBookId(),
            $giveBackBookCommand->getUserId()
        );
        $activeUser = BorrowTestData::anyActiveUserWithBorrowedBooks($giveBackBookCommand->getUserId(), [$borrowedBook]);

        $this->database->borrowedBooks[$borrowedBook->getId()] = $borrowedBook;
        $this->database->activeUsers[$activeUser->getId()] = $activeUser;

        //when
        $this->borrowingFacade->handleGiveBackBookCommand($giveBackBookCommand);

        //then
        $this->assertCount(0, $this->database->borrowedBooks);
        $this->assertCount(1, $this->database->availableBooks);
        $this->assertCount(0, $this->database->activeUsers[$activeUser->getId()]->getBorrowedBooks());
    }
}
