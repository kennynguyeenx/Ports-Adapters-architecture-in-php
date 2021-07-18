<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model;

/**
 * Class ReservationConfirmEmail
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model
 */
class ReservationConfirmEmail
{
    /**
     * @var EmailAddress
     */
    private $from;
    /**
     * @var EmailAddress
     */
    private $to;
    /**
     * @var string
     */
    private $subject;
    /**
     * @var string
     */
    private $content;

    /**
     * ReservationConfirmEmail constructor.
     * @param EmailAddress $from
     * @param EmailAddress $to
     * @param string $subject
     * @param string $content
     */
    public function __construct(
        EmailAddress $from,
        EmailAddress $to,
        string $subject,
        string $content
    ) {
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * @return EmailAddress
     */
    public function getFromEmailAddressAsString(): EmailAddress
    {
        return $this->from;
    }

    /**
     * @return EmailAddress
     */
    public function getToEmailAddressAsString(): EmailAddress
    {
        return $this->to;
    }

    /**
     * @return string
     */
    public function getSubjectAsString(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getContentAsString(): string
    {
        return $this->content;
    }
}
