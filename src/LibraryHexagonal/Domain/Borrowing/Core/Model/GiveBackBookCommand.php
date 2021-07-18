<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model;

/**
 * Class GiveBackBookCommand
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model
 */
class GiveBackBookCommand
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
     * @return GiveBackBookCommand
     */
    public function setBookId(int $bookId): GiveBackBookCommand
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
     * @return GiveBackBookCommand
     */
    public function setUserId(int $userId): GiveBackBookCommand
    {
        $this->userId = $userId;
        return $this;
    }
}
