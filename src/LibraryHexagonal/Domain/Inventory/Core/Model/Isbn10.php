<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model;

use InvalidArgumentException;

/**
 * Class Isbn10
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model
 */
class Isbn10
{
    /**
     * @var string
     */
    private $value;

    /**
     * Isbn10 constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (preg_match('/^\d{10}$/', $value)) {
            $this->value = $value;
        } else {
            throw new InvalidArgumentException("ISBN-10 should have 10 digits only.");
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
