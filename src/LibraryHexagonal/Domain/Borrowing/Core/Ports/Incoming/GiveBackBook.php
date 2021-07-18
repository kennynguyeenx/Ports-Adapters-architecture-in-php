<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Incoming;

use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\GiveBackBookCommand;

/**
 * Interface GiveBackBook
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Incoming
 */
interface GiveBackBook
{
    /**
     * @param GiveBackBookCommand $giveBackBookCommand
     * @return void
     */
    public function handleGiveBackBookCommand(GiveBackBookCommand $giveBackBookCommand): void;
}
