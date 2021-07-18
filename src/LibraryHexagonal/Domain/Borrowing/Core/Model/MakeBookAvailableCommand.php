<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model;

/**
 * Class MakeBookAvailableCommand
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model
 */
class MakeBookAvailableCommand
{
    /**
     * @var int
     */
    private $bookId;

    /**
     * @return int
     */
    public function getBookId(): int
    {
        return $this->bookId;
    }

    /**
     * @param int $bookId
     * @return MakeBookAvailableCommand
     */
    public function setBookId(int $bookId): MakeBookAvailableCommand
    {
        $this->bookId = $bookId;
        return $this;
    }
}
