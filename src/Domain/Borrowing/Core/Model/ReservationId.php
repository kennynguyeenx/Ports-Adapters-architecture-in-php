<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model;

/**
 * Class UserIdentifier
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model
 */
class ReservationId
{
    /**
     * @var int
     */
    private $id;

    /**
     * ReservationId constructor.
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
