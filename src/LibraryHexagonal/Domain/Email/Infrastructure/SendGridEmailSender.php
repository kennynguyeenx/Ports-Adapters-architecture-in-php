<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Email\Infrastructure;

use Exception;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model\ReservationConfirmEmail;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\EmailSender;
use SendGrid;
use SendGrid\Mail\Mail;
use SendGrid\Mail\TypeException;

/**
 * Class UserRepository
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Email\Infrastructure
 */
class SendGridEmailSender implements EmailSender
{
    /**
     * @var string
     */
    private $sendgridApiKey;

    /**
     * SendGridEmailSender constructor.
     * @param string $sendgridApiKey
     */
    public function __construct(string $sendgridApiKey)
    {
        $this->sendgridApiKey = $sendgridApiKey;
    }

    /**
     * @param ReservationConfirmEmail $reservationConfirmEmail
     * @throws TypeException
     */
    public function sendReservationConfirmationEmail(ReservationConfirmEmail $reservationConfirmEmail): void
    {
        $mail = new Mail(
            $reservationConfirmEmail->getFromEmailAddressAsString(),
            $reservationConfirmEmail->getToEmailAddressAsString(),
            $reservationConfirmEmail->getSubjectAsString(),
            $reservationConfirmEmail->getContentAsString()
        );

        $sendgrid = new SendGrid($this->sendgridApiKey);
        try {
            $response = $sendgrid->send($mail);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
