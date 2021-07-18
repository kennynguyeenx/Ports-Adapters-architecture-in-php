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
     * GiveBackBookCommand constructor.
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
