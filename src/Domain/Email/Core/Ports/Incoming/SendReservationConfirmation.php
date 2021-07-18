<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports;

use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model\SendReservationConfirmationCommand;

/**
 * Interface SendReservationConfirmation
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports
 */
interface SendReservationConfirmation
{
    /**
     * @param SendReservationConfirmationCommand $sendReservationConfirmationCommand
     * @return void
     */
    public function handle(SendReservationConfirmationCommand $sendReservationConfirmationCommand): void;
}
