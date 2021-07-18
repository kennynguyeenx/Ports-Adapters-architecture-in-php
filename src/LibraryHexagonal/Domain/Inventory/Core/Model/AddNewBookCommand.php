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
     * @return string
     */
    public function getGoogleBookId(): string
    {
        return $this->googleBookId;
    }

    /**
     * @param string $googleBookId
     * @return AddNewBookCommand
     */
    public function setGoogleBookId(string $googleBookId): AddNewBookCommand
    {
        $this->googleBookId = $googleBookId;
        return $this;
    }
}
