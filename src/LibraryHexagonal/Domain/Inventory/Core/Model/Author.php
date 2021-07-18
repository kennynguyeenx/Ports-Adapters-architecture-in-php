<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model;

/**
 * Class Author
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model
 */
class Author
{
    /**
     * @var string
     */
    private $name;

    /**
     * Author constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
