<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model;

/**
 * Class BookIdentification
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model
 */
class BookIdentification
{
    /**
     * @var string
     */
    private $bookExternalId;
    /**
     * @var Isbn10
     */
    private $isbn10;
    /**
     * @var Isbn13
     */
    private $isbn13;

    /**
     * BookIdentification constructor.
     * @param string $bookExternalId
     * @param Isbn10 $isbn10
     * @param Isbn13 $isbn13
     */
    public function __construct(string $bookExternalId, Isbn10 $isbn10, Isbn13 $isbn13)
    {
        $this->bookExternalId = $bookExternalId;
        $this->isbn10 = $isbn10;
        $this->isbn13 = $isbn13;
    }

    /**
     * @return string
     */
    public function getBookExternalId(): string
    {
        return $this->bookExternalId;
    }

    /**
     * @return Isbn10
     */
    public function getIsbn10(): Isbn10
    {
        return $this->isbn10;
    }

    /**
     * @return Isbn13
     */
    public function getIsbn13(): Isbn13
    {
        return $this->isbn13;
    }
}
