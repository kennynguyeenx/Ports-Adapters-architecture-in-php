<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model;

use DateTime;

/**
 * Class DueDate
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model
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
