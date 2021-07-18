<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Email\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\EmailDatabase;

/**
 * Class EmailDatabaseAdapter
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Email\Infrastructure
 */
class EmailDatabaseAdapter implements EmailDatabase
{
    /**
     * @param int $bookId
     * @return string|null
     */
    public function getTitleByBookId(int $bookId): ?string
    {
        // "SELECT title FROM book WHERE id = ?",
        //                    String.class,
        //                    bookId
        return null;
    }

    /**
     * @param int $userId
     * @return string|null
     */
    public function getUserEmailAddress(int $userId): ?string
    {
        // "SELECT email FROM library_user WHERE id = ?",
        //                    String.class,
        //                    userId
        return null;
    }
}
