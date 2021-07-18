<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model;

use DateTime;

/**
 * Class BorrowedBook
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model
 */
class BorrowedBook implements Book
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
    private $borrowedDate;

    /**
     * BorrowedBook constructor.
     * @param int $bookId
     * @param int $userId
     * @param DateTime|null $borrowedDate
     */
    public function __construct(int $bookId, int $userId, DateTime $borrowedDate = null)
    {
        $this->bookId = $bookId;
        $this->userId = $userId;
        if (! is_null($borrowedDate)) {
            $this->borrowedDate = $borrowedDate;
        } else {
            $this->borrowedDate = new DateTime();
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
    public function getBorrowedDate(): DateTime
    {
        return $this->borrowedDate;
    }
}
