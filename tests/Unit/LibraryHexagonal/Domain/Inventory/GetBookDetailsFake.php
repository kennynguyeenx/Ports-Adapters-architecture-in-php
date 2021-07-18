<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal\Domain\Inventory;

use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Book;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\GetBookDetails;
use Tests\Unit\LibraryHexagonal\BookTestData;

/**
 * Class GetBookDetailsFake
 * @package Tests\Unit\LibraryHexagonal\Domain\Inventory
 */
class GetBookDetailsFake implements GetBookDetails
{
    /**
     * @var Book[]
     */
    private $books = [];

    public function __construct()
    {
        $this->books[BookTestData::homoDeusBookGoogleId()] = BookTestData::homoDeusBook();
    }

    /**
     * @param string $bookId
     * @return Book
     */
    public function handle(string $bookId): Book
    {
        return $this->books[$bookId];
    }
}
