<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Email\Core;

use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model\EmailAddress;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model\ReservationConfirmEmail;

/**
 * Class EmailCreator
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Email\Core
 */
class EmailCreator
{
    /**
     * @param int $reservationId
     * @param string $bookTitle
     * @param string $emailTo
     * @return ReservationConfirmEmail
     */
    public static function reservationEmail(int $reservationId, string $bookTitle, string $emailTo): ReservationConfirmEmail
    {
        $from = new EmailAddress("kenny@library.com");
        $to = new EmailAddress($emailTo);

        $subject = sprintf("Library - book reservation confirmation (id - %d)", $reservationId);
        $content = sprintf("Dear reader, you have reserved a %s book which will "
            . "be waiting for you in our library for next 2 days. Your reservation id is %d. "
            . "Have a nice day, Library",
            $bookTitle,
            $reservationId
        );
        return new ReservationConfirmEmail($from, $to, $subject, $content);
    }
}
