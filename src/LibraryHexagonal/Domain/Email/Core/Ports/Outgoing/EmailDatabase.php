<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\Outgoing;

/**
 * Interface EmailDatabase
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\Outgoing
 */
interface EmailDatabase
{
    /**
     * @param int $bookId
     * @return string|null
     */
    public function getTitleByBookId(int $bookId): ?string;

    /**
     * @param int $userId
     * @return string|null
     */
    public function getUserEmailAddress(int $userId): ?string;
}
