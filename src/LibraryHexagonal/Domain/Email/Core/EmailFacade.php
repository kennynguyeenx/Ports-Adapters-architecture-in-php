<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Email\Core;

use InvalidArgumentException;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model\SendReservationConfirmationCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\Incoming\SendReservationConfirmation;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\Outgoing\EmailDatabase;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\Outgoing\EmailSender;

/**
 * Class UserFacade
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Email\Core
 */
class EmailFacade implements SendReservationConfirmation
{
    /**
     * @var EmailDatabase
     */
    private $emailDatabase;
    /**
     * @var EmailSender
     */
    private $emailSender;

    /**
     * EmailFacade constructor.
     * @param EmailDatabase $emailDatabase
     * @param EmailSender $emailSender
     */
    public function __construct(EmailDatabase $emailDatabase, EmailSender $emailSender)
   {
       $this->emailDatabase = $emailDatabase;
       $this->emailSender = $emailSender;
   }


    /**
     * @param SendReservationConfirmationCommand $sendReservationConfirmationCommand
     */
    public function handle(SendReservationConfirmationCommand $sendReservationConfirmationCommand): void
    {
        $bookId = $sendReservationConfirmationCommand->getBookId();
        $bookTitle = $this->emailDatabase->getTitleByBookId($bookId);

        if (empty($bookTitle)) {
            throw new InvalidArgumentException(
                "Can't get book title from database. Reason: there is no book with an id: " . $bookId
            );
        }

        $userId = $sendReservationConfirmationCommand->getUserId();
        $userEmailAddress = $this->emailDatabase->getUserEmailAddress($userId);

        if (empty($userEmailAddress)) {
            throw new InvalidArgumentException(
                "Can't get email address from database. Reason: there is no user with an id: " . $userId
            );
        }

        $reservationConfirmEmail = EmailCreator::reservationEmail(
            $sendReservationConfirmationCommand->getReservationId(),
            $bookTitle,
            $userEmailAddress
        );

        $this->emailSender->sendReservationConfirmationEmail($reservationConfirmEmail);
    }
}
