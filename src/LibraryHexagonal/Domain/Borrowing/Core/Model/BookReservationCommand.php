<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model;

/**
 * Class BookReservationCommand
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model
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
     * @return int
     */
    public function getBookId(): int
    {
        return $this->bookId;
    }

    /**
     * @param int $bookId
     * @return BookReservationCommand
     */
    public function setBookId(int $bookId): BookReservationCommand
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
     * @return BookReservationCommand
     */
    public function setUserId(int $userId): BookReservationCommand
    {
        $this->userId = $userId;
        return $this;
    }
}
