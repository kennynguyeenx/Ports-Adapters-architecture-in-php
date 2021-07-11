<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model;

/**
 * Class BookReservationCommand
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model
 */
class BookReservationCommand
{
    /**
     * @var int
     */
    private $bookId;
    /**
     * @var int
     */
    private $userId;

    /**
     * BookReservationCommand constructor.
     * @param int $bookId
     * @param int $userId
     */
    public function __construct(int $bookId, int $userId)
    {
        $this->bookId = $bookId;
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getBookId(): int
    {
        return $this->bookId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
