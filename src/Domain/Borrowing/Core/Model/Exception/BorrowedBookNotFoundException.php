<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\Exception;

use Exception;

/**
 * Class BorrowedBookNotFoundException
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\Exception
 */
class BorrowedBookNotFoundException extends Exception
{
    /**
     * BorrowedBookNotFoundException constructor.
     * @param int $bookId
     */
    public function __construct(int $bookId)
    {
        parent::__construct(
            "There is no borrowed book with an ID: " . $bookId,
            0,
            null
        );
    }
}
