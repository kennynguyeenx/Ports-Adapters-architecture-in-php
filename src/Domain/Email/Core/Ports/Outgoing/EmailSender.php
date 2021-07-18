<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports;

use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model\ReservationConfirmEmail;

/**
 * Interface EmailSender
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports
 */
interface EmailSender
{
    /**
     * @param ReservationConfirmEmail $reservationConfirmEmail
     * @return void
     */
    public function sendReservationConfirmationEmail(ReservationConfirmEmail $reservationConfirmEmail);
}
