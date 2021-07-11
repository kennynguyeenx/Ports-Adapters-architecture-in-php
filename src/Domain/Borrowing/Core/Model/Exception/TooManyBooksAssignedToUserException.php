<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\Exception;

use Exception;

/**
 * Class TooManyBooksAssignedToUserException
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model\Exception
 */
class TooManyBooksAssignedToUserException extends Exception
{
    /**
     * TooManyBooksAssignedToUserException constructor.
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        parent::__construct(
            "You can't assign another book to user account: " . $userId
            . ". Reason: Too many books already assigned.",
            0,
            null
        );
    }
}
