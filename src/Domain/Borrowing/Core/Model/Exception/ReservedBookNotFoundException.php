<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\Exception;

use Exception;

/**
 * Class ReservedBookNotFoundException
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\Exception
 */
class ReservedBookNotFoundException extends Exception
{
    /**
     * ReservedBookNotFoundException constructor.
     * @param int $bookId
     */
    public function __construct(int $bookId)
    {
        parent::__construct(
            "There is no reserved book with an ID: " . $bookId,
            0,
            null
        );
    }
}
