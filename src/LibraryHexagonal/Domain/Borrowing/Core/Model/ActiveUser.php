<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model;

use InvalidArgumentException;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\Exception\TooManyBooksAssignedToUserException;

/**
 * Class ActiveUser
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model
 */
class ActiveUser
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var ReservedBook[]
     */
    private $reservedBooks;
    /**
     * @var BorrowedBook[]
     */
    private $borrowedBooks;

    /**
     * ActiveUser constructor.
     * @param int $id
     * @param ReservedBook[] $reservedBooks
     * @param BorrowedBook[] $borrowedBooks
     */
    public function __construct(int $id, array $reservedBooks, array $borrowedBooks)
    {
        $this->id = $id;
        $this->reservedBooks = $reservedBooks;
        $this->borrowedBooks = $borrowedBooks;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return ReservedBook[]
     */
    public function getReservedBooks(): array
    {
        return $this->reservedBooks;
    }

    /**
     * @return BorrowedBook[]
     */
    public function getBorrowedBooks(): array
    {
        return $this->borrowedBooks;
    }

    /**
     * @param AvailableBook $availableBook
     * @return ReservedBook
     * @throws TooManyBooksAssignedToUserException
     */
    public function reserve(AvailableBook $availableBook): ReservedBook
    {
        if ($this->hasUserNotReachedLimitOfBooks()) {
            $reservedBook = new ReservedBook($availableBook->getId(), $this->id);
            $this->reservedBooks[] = $reservedBook;
            return $reservedBook;
        } else {
            throw new TooManyBooksAssignedToUserException($this->id);
        }
    }

    /**
     * @param ReservedBook $reservedBook
     * @return BorrowedBook
     * @throws TooManyBooksAssignedToUserException
     */
    public function borrow(ReservedBook $reservedBook): BorrowedBook
    {
        if ($this->hasUserNotReachedLimitOfBooks()) {
            $borrowedBook = new BorrowedBook($reservedBook->getId(), $this->id);
            $this->borrowedBooks[] = $borrowedBook;
            return $borrowedBook;
        } else {
            throw new TooManyBooksAssignedToUserException($this->id);
        }
    }

    /**
     * @param BorrowedBook $borrowedBook
     * @return AvailableBook
     */
    public function giveBack(BorrowedBook $borrowedBook): AvailableBook
    {
        if (($index = array_search($borrowedBook, $this->borrowedBooks)) !== false) {
            unset($this->borrowedBooks[$index]);
            return new AvailableBook($borrowedBook->getId());
        } else {
            throw new InvalidArgumentException(
                "User with an id: " . $this->id . " didn't borrow book with an id: " . $borrowedBook->getId()
            );
        }
    }

    /**
     * @return bool
     */
    private function hasUserNotReachedLimitOfBooks(): bool
    {
        return count($this->reservedBooks) + count($this->borrowedBooks) < 3;
    }
}
