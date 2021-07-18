<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model;

use InvalidArgumentException;

/**
 * Class Isbn13
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model
 */
class Isbn13
{
    /**
     * @var string
     */
    private $value;

    /**
     * Isbn13 constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (preg_match('/^\d{13}$/', $value)) {
            $this->value = $value;
        } else {
            throw new InvalidArgumentException("ISBN-13 should have 13 digits only.");
        }
    }

    /**
     * @return string
     */
    public function getAsString(): string
    {
        return $this->value;
    }
}
