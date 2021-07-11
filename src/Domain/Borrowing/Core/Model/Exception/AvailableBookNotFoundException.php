<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\Exception;

use Exception;

/**
 * Class AvailableBookNotFoundException
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\Exception
 */
class AvailableBookNotFoundException extends Exception
{
    /**
     * AvailableBookNotFoundException constructor.
     * @param int $bookId
     */
    public function __construct(int $bookId)
    {
        parent::__construct(
            "There is no available book with an ID: " . $bookId,
            0,
            null
        );
    }
}
