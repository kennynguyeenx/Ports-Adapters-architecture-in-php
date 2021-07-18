<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model;

/**
 * Class BorrowBookCommand
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model
 */
class BorrowBookCommand
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
     * @return int
     */
    public function getBookId(): int
    {
        return $this->bookId;
    }

    /**
     * @param int $bookId
     * @return BorrowBookCommand
     */
    public function setBookId(int $bookId): BorrowBookCommand
    {
        $this->bookId = $bookId;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return BorrowBookCommand
     */
    public function setUserId(int $userId): BorrowBookCommand
    {
        $this->userId = $userId;
        return $this;
    }
}
