<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model;

/**
 * Interface Book
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model
 */
interface Book
{
    /**
     * @return int
     */
    public function getId(): int;
}
