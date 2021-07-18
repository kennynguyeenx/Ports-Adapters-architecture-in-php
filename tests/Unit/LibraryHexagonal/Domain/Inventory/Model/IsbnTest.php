<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal\Domain\Invetory\Model;

use InvalidArgumentException;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Isbn10;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Isbn13;
use PHPUnit\Framework\TestCase;

/**
 * Class EmailAddressTest
 * @package Tests\Unit\LibraryHexagonal\Domain\Invetory\Model
 */
class IsbnTest extends TestCase
{
    /**
     * @test
     * @covers \Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Isbn10::__construct()
     */
    public function shouldCreateCorrectISBN10()
    {
        $this->assertEquals("1473545374", (new Isbn10("1473545374"))->getAsString());
    }

    /**
     * @test
     * @covers \Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Isbn13::__construct()
     */
    public function shouldCreateCorrectISBN13()
    {
        $this->assertEquals("9781473545373", (new Isbn13("9781473545373"))->getAsString());
    }

    /**
     * @test
     * @covers \Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Isbn10::__construct()
     */
    public function shouldNotCreateCorrectISBN10()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("ISBN-10 should have 10 digits only.");
        new Isbn10("9781473545373");
    }

    /**
     * @test
     * @covers \Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Isbn13::__construct()
     */
    public function shouldNotCreateCorrectISBN13()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("ISBN-13 should have 13 digits only.");
        new Isbn13("1473545374");
    }
}
