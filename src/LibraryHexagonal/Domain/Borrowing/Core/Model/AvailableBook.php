<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model;

/**
 * Class AvailableBook
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model
 */
class AvailableBook implements Book
{
    /**
     * @var int
     */
    public int $id;
    /**
     * @var int
     */
    private int $bookId;

    /**
     * AvailableBook constructor.
     * @param int $bookId
     */
    public function __construct(int $bookId)
    {
        $this->bookId = $bookId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->bookId;
    }
}
