<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model;

use DateTime;

/**
 * Class NewBookWasAddedEvent
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model
 */
class NewBookWasAddedEvent
{
    /**
     * @var int
     */
    private $bookId;
    /**
     * @var DateTime
     */
    private $timeStamp;

    /**
     * NewBookWasAddedEvent constructor.
     * @param int $bookId
     */
    public function __construct(int $bookId)
    {
        $this->bookId = $bookId;
        $this->timeStamp = new DateTime();
    }

    /**
     * @return int
     */
    public function getBookId(): int
    {
        return $this->bookId;
    }

    /**
     * @return string
     */
    public function getTimeStampAsString(): string
    {
        return $this->timeStamp->format('Y-m-d H:i:s');
    }
}
