<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal;

use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Author;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Book;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\BookIdentification;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Isbn10;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Isbn13;

/**
 * Class BookTestData
 * @package Tests\Unit\LibraryHexagonal
 */
class BookTestData
{
    /**
     * @return string
     */
    public static function homoDeusBookGoogleId(): string
    {
        return "dWYyCwAAQBAJ";
    }

    /**
     * @return string
     */
    public static function homoDeusBookTitle(): string
    {
        return "Homo Deus";
    }

    public static function homoDeusBook(): Book
    {
        $isbn10 = new Isbn10("1473545374");
        $isbn13 = new Isbn13("9781473545373");

        return new Book(
                new BookIdentification(self::homoDeusBookGoogleId(), $isbn10, $isbn13),
                self::homoDeusBookTitle(),
                [new Author("Yuval Noah Harari")],
                "Random House",
                "2016-09-08",
                "<p><b>**THE MILLION COPY BESTSELLER**</b><br> <b></b><br><b> <i>Sapiens </i>showed us where we came from. In uncertain times, <i>Homo Deus</i> shows us where we’re going.</b></p><p> Yuval Noah Harari envisions a near future in which we face a new set of challenges. <i>Homo Deus</i> explores the projects, dreams and nightmares that will shape the twenty-first century and beyond – from overcoming death to creating artificial life.</p><p> It asks the fundamental questions: how can we protect this fragile world from our own destructive power? And what does our future hold?<br> <b></b><br><b> '<i>Homo Deus</i> will shock you. It will entertain you. It will make you think in ways you had not thought before’ Daniel Kahneman, bestselling author of <i>Thinking, Fast and Slow</i></b></p>",
                528,
                "http://books.google.com/books/content?id=dWYyCwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&imgtk=AFLRE73PkLs4TNB-W2uhDvXJkIB4-9G9AJ_L1iYTYLEXa3zi2kahdsN9-_0tL7WRWgujNpjMA5ZuJO7_ykFUlCWAyLzcQVcGkqUS-NOkUkEcJ_ZRrgq48URpcfBrJWQCwSWtHo5pEGkp&source=gbs_api"
        );
    }
}
