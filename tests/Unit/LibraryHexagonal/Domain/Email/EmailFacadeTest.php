<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal\Domain\Email;

use InvalidArgumentException;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\EmailFacade;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model\SendReservationConfirmationCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\Outgoing\EmailDatabase;
use PHPUnit\Framework\TestCase;
use Tests\Unit\LibraryHexagonal\BookTestData;
use Tests\Unit\LibraryHexagonal\UserTestData;

/**
 * @coversDefaultClass \Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\EmailFacade
 * Class EmailFacadeTest
 * @package Tests\Unit\LibraryHexagonal\Domain\Email
 */
class EmailFacadeTest extends TestCase
{
    /**
     * @var EmailDatabase
     */
    private $database;
    /**
     * @var EmailSenderFake
     */
    private $emailSender;
    /**
     * @var EmailFacade
     */
    private $emailFacade;

    public function setUp(): void
    {
        parent::setUp();
        $this->database = new InMemoryEmailDatabase();
        $this->emailSender = new EmailSenderFake();
        $this->emailFacade = new EmailFacade($this->database, $this->emailSender);

        $this->database->emailAddresses[1] = UserTestData::kennyEmail();
        $this->database->bookTitles[1] = BookTestData::homoDeusBookTitle();
    }

    /**
     * @test
     * @covers ::handle()
     */
    public function shouldPrepareAndSendReservationConfirmation()
    {
        //given
        $sendReservationConfirmationCommand = new SendReservationConfirmationCommand(1, 1, 1);

        $this->emailFacade->handle($sendReservationConfirmationCommand);
        $this->addToAssertionCount(1);
    }

    /**
     * @test
     * @covers ::handle()
     */
    public function invalidBookIdShouldThrowAnException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Can't get book title from database. Reason: there is no book with an id: 2");

        $sendReservationConfirmationCommand = new SendReservationConfirmationCommand(
            1,
            1,
            2
        );

        $this->emailFacade->handle($sendReservationConfirmationCommand);
    }

    /**
     * @test
     * @covers ::handle()
     */
    public function invalidUserIdShouldThrowAnException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Can't get email address from database. Reason: there is no user with an id: 2");

        $sendReservationConfirmationCommand = new SendReservationConfirmationCommand(
            1,
            2,
            1
        );

        $this->emailFacade->handle($sendReservationConfirmationCommand);
    }
}
