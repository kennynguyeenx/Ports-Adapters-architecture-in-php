<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal\Domain\Borrowing;

use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\ActiveUser;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BorrowBookCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BorrowedBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\GiveBackBookCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\ReservedBook;

/**
 * Class BorrowTestData
 * @package Tests\Unit\LibraryHexagonal\Domain\Borrowing
 */
class BorrowTestData
{
    /**
     * @param int $bookId
     * @param int $userId
     * @return BorrowBookCommand
     */
    public static function anyBorrowBookCommand(int $bookId, int $userId): BorrowBookCommand
    {
        return (new BorrowBookCommand())
                ->setBookId($bookId)
                ->setUserId($userId);
    }

    public static function anyGiveBookCommand(int $bookId, int $userId): GiveBackBookCommand
    {
        return (new GiveBackBookCommand())
            ->setBookId($bookId)
            ->setUserId($userId);
    }

    /**
     * @param int $bookId
     * @param int $userId
     * @return ReservedBook
     */
    public static function anyReservedBook(int $bookId, int $userId): ReservedBook
    {
        return new ReservedBook($bookId, $userId);
    }

    /**
     * @param int $bookId
     * @param int $userId
     * @return BorrowedBook
     */
    public static function anyBorrowedBook(int $bookId, int $userId): BorrowedBook
    {
        return new BorrowedBook($bookId, $userId);
    }

    /**
     * @param int $userId
     * @return ActiveUser
     */
    public static function anyActiveUser(int $userId): ActiveUser
    {
        return new ActiveUser($userId, [], []);
    }

    /**
     * @param int $userId
     * @param ReservedBook[] $reservedBookList
     * @return ActiveUser
     */
    public static function anyActiveUserWithReservedBooks(int $userId, array $reservedBookList): ActiveUser
    {
        return new ActiveUser($userId, $reservedBookList, []);
    }

    /**
     * @param int $userId
     * @param BorrowedBook[] $borrowedBooksList
     * @return ActiveUser
     */
    public static function anyActiveUserWithBorrowedBooks(int $userId, array $borrowedBooksList): ActiveUser
    {
        return new ActiveUser($userId, [], $borrowedBooksList);
    }
}
