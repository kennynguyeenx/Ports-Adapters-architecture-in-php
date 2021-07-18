<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Incoming;

use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\AddNewBookCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\BookIdentification;

/**
 * Interface AddNewBook
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Incoming
 */
interface AddNewBook
{
    /**
     * @param AddNewBookCommand $addNewBookCommand
     * @return void
     */
    public function handle(AddNewBookCommand $addNewBookCommand): void;
}
