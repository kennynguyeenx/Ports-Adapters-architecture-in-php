<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Email\Application;

use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BookReservedEvent;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model\SendReservationConfirmationCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\SendReservationConfirmation;

/**
 * Class BookReservedEventHandler
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Email\Application
 */
class BookReservedEventHandler
{
    /**
     * @var SendReservationConfirmation
     */
    private $sendReservationConfirmation;

    /**
     * BookReservedEventHandler constructor.
     * @param SendReservationConfirmation $sendReservationConfirmation
     */
    public function __construct(SendReservationConfirmation $sendReservationConfirmation)
    {
        $this->sendReservationConfirmation = $sendReservationConfirmation;
    }

    /**
     * @param BookReservedEvent $bookReservedEvent
     * @return void
     */
    public function handle(BookReservedEvent $bookReservedEvent): void
    {
        $this->sendReservationConfirmation->handle(
            new SendReservationConfirmationCommand(
                $bookReservedEvent->getReservationId(),
                $bookReservedEvent->getUserId(),
                $bookReservedEvent->getBookId()
            )
        );
    }
}
