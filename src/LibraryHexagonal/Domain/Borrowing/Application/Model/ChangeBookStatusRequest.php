<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Application\Model;

/**
 * Class ChangeBookStatusRequest
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Application\Model
 */
class ChangeBookStatusRequest
{
    /**
     * @var int
     */
    private $userId;
    /**
     * @var BookStatus
     */
    private $bookStatus;

    /**
     * ChangeBookStatusRequest constructor.
     * @param int $userId
     * @param BookStatus $bookStatus
     */
    public function __construct(int $userId, BookStatus $bookStatus)
    {
        $this->userId = $userId;
        $this->bookStatus = $bookStatus;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return BookStatus
     */
    public function getBookStatus(): BookStatus
    {
        return $this->bookStatus;
    }
}
