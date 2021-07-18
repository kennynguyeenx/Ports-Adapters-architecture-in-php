<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal\Domain\Email;

use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model\ReservationConfirmEmail;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\Outgoing\EmailSender;

/**
 * Class EmailSenderFake
 * @package Tests\Unit\LibraryHexagonal\Domain\Email
 */
class EmailSenderFake implements EmailSender
{
    /**
     * @param ReservationConfirmEmail $reservationConfirmEmail
     */
    public function sendReservationConfirmationEmail(ReservationConfirmEmail $reservationConfirmEmail)
    {
        // TODO: Implement sendReservationConfirmationEmail() method.
    }
}
