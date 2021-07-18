<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Application\Model;

use InvalidArgumentException;

/**
 * Class BookStatus
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Application\Model
 */
class BookStatus
{
    const AVAILABLE = 'AVAILABLE';
    const RESERVED = 'RESERVED';
    const BORROWED = 'BORROWED';

    /**
     * @var array
     */
    public static $statusArray = [
        self::AVAILABLE,
        self::RESERVED,
        self::BORROWED
    ];
    /**
     * @var string
     */
    private $status;

    /**
     * BookStatus constructor.
     * @param string $status
     */
    public function __construct(string $status)
    {
        if (in_array($status, self::$statusArray)) {
            $this->status = $status;
        } else {
            throw new InvalidArgumentException('Invalid status : ' . $status);
        }
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
