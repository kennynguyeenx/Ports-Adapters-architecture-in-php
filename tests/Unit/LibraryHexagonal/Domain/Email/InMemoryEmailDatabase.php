<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal\Domain\Email;

use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\Outgoing\EmailDatabase;

/**
 * Class InMemoryEmailDatabase
 * @package Tests\Unit\LibraryHexagonal\Domain\Email
 */
class InMemoryEmailDatabase implements EmailDatabase
{
    /**
     * @var string[]
     */
    public $emailAddresses = [];
    /**
     * @var string[]
     */
    public $bookTitles = [];

    /**
     * @param int $userId
     * @return string|null
     */
    public function getUserEmailAddress(int $userId): ?string
    {
        return $this->emailAddresses[$userId] ?? null;
    }

    /**
     * @param int $bookId
     * @return string|null
     */
    public function getTitleByBookId(int $bookId): ?string
    {
        return $this->bookTitles[$bookId] ?? null;
    }
}
