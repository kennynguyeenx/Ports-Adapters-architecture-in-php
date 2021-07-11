<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\Exception;

use Exception;

/**
 * Class ActiveUserNotFoundException
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\Exception
 */
class ActiveUserNotFoundException extends Exception
{
    /**
     * ActiveUserNotFoundException constructor.
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        parent::__construct(
            "There is no active user with an ID: " . $userId,
            0,
            null
        );
    }
}
