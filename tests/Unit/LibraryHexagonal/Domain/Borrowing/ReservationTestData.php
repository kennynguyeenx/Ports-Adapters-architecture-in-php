<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal\Domain\Borrowing;

use DateTime;
use Exception;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\ActiveUser;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\AvailableBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BookReservationCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\ReservedBook;

/**
 * Class ReservationTestData
 * @package Tests\Unit\LibraryHexagonal\Domain\Borrowing
 */
class ReservationTestData
{
    /**
     * @param int $bookId
     * @param int $userId
     * @return BookReservationCommand
     */
    public static function anyBookReservationCommand(int $bookId, int $userId): BookReservationCommand
    {
        return (new BookReservationCommand())
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
     * @param int $days
     * @return ReservedBook
     * @throws Exception
     */
    public static function getReservedBookWithCustomDate(int $bookId, int $userId, int $days): ReservedBook
    {
        return new ReservedBook($bookId, $userId, new DateTime('-' . $days . ' days'));
    }

    /**
     * @param int $bookId
     * @return AvailableBook
     */
    public static function anyAvailableBook(int $bookId): AvailableBook
    {
        return new AvailableBook($bookId);
    }

    /**
     * @param int $userId
     * @return ActiveUser
     */
    public static function anyActiveUser(int $userId): ActiveUser
    {
        return new ActiveUser($userId, [], []);
    }
}
