<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Incoming;

use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BorrowBookCommand;

/**
 * Interface BorrowBook
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Incoming
 */
interface BorrowBook
{
    /**
     * @param BorrowBookCommand $borrowBookCommand
     * @return void
     */
    public function handleBorrowBookCommand(BorrowBookCommand $borrowBookCommand): void;
}
