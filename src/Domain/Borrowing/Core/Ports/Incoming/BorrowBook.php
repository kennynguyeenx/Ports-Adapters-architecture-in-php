<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Incoming;

use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\BorrowBookCommand;

/**
 * Interface BorrowBook
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Incoming
 */
interface BorrowBook
{
    /**
     * @param BorrowBookCommand $borrowBookCommand
     * @return void
     */
    public function handleBorrowBookCommand(BorrowBookCommand $borrowBookCommand): void;
}
