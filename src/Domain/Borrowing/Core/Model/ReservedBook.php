<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model;

use DateTime;

/**
 * Class ReservedBook
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model
 */
class ReservedBook implements Book
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
     * @var DateTime
     */
    private $reservedDate;

    /**
     * ReservedBook constructor.
     * @param int $bookId
     * @param int $userId
     * @param DateTime|null $reservedDate
     */
    public function __construct(int $bookId, int $userId, DateTime $reservedDate = null)
    {
        $this->bookId = $bookId;
        $this->userId = $userId;
        if (! is_null($reservedDate)) {
            $this->reservedDate = $reservedDate;
        } else {
            $this->reservedDate = new DateTime();
        }
    }

    /**
     * @return int
     */
    public function getId(): int
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

    /**
     * @return DateTime
     */
    public function getReservedDate(): DateTime
    {
        return $this->reservedDate;
    }
}
