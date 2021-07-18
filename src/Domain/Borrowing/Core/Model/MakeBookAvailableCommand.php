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
     * MakeBookAvailableCommand constructor.
     * @param int $bookId
     */
    public function __construct(int $bookId)
    {
        $this->bookId = $bookId;
    }

    /**
     * @return int
     */
    public function getBookId(): int
    {
        return $this->bookId;
    }
}
