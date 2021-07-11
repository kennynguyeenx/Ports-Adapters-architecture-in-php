<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Incoming;

use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\GiveBackBookCommand;

/**
 * Interface GiveBackBook
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Incoming
 */
interface GiveBackBook
{
    /**
     * @param GiveBackBookCommand $giveBackBookCommand
     * @return void
     */
    public function handleGiveBackBookCommand(GiveBackBookCommand $giveBackBookCommand): void;
}
