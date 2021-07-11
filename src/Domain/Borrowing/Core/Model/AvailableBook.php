<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model;

/**
 * Class AvailableBook
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model
 */
class AvailableBook implements Book
{
    /**
     * @var int
     */
    private $id;

    /**
     * AvailableBook constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
