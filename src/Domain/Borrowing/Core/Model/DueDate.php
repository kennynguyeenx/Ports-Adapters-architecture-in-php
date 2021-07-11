<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model;

use DateTime;

/**
 * Class DueDate
 * @package Kennynguyeenx\PortsAndAdapters\Domain\Borrowing\Core\Model
 */
class DueDate
{
    /**
     * @var DateTime
     */
    private $timeStamp;

    /**
     * DueDate constructor.
     * @param DateTime $timeStamp
     */
    public function __construct(DateTime $timeStamp)
    {
        $this->timeStamp = $timeStamp;
    }

    /**
     * @return DateTime
     */
    public function getTimeStamp(): DateTime
    {
        return $this->timeStamp;
    }
}
