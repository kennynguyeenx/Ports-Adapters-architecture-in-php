<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Model;

/**
 * Class UserIdentifier
 * @package Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Model
 */
class UserIdentifier
{
    /**
     * @var int
     */
    private $id;

    /**
     * UserIdentifier constructor.
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
