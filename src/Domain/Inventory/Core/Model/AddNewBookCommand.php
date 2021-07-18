<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model;

/**
 * Class AddNewBookCommand
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model
 */
class AddNewBookCommand
{
    /**
     * @var string
     */
    private $googleBookId;

    /**
     * AddNewBookCommand constructor.
     * @param string $googleBookId
     */
    public function __construct(string $googleBookId)
    {
        $this->googleBookId = $googleBookId;
    }

    /**
     * @return string
     */
    public function getGoogleBookId(): string
    {
        return $this->googleBookId;
    }
}
