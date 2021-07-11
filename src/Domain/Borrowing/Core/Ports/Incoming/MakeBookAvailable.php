<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Incoming;

use Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\MakeBookAvailableCommand;

/**
 * Interface MakeBookAvailable
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Ports\Incoming
 */
interface MakeBookAvailable
{
    /**
     * @param MakeBookAvailableCommand $makeBookAvailableCommand
     * @return void
     */
    public function handleMakeBookAvailableCommand(MakeBookAvailableCommand $makeBookAvailableCommand): void;
}
