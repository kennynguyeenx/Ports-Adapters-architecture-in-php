<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model;

/**
 * Class SendReservationConfirmationCommand
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model
 */
class SendReservationConfirmationCommand
{
    /**
     * @var int
     */
    private $reservationId;
    /**
     * @var int
     */
    private $userId;
    /**
     * @var int
     */
    private $bookId;

    /**
     * SendReservationConfirmationCommand constructor.
     * @param int $reservationId
     * @param int $userId
     * @param int $bookId
     */
    public function __construct(int $reservationId, int $userId, int $bookId)
    {
        $this->reservationId = $reservationId;
        $this->userId = $userId;
        $this->bookId = $bookId;
    }

    /**
     * @return int
     */
    public function getReservationId(): int
    {
        return $this->reservationId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getBookId(): int
    {
        return $this->bookId;
    }
}
