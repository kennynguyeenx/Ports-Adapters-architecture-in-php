<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Outgoing\BorrowingDatabase;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Outgoing\BorrowingEventPublisher;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure\BorrowingDatabaseAdapter;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure\KafkaBorrowingEventPublisherAdapter;

/**
 * Class BorrowingDomainConfig
 * @package Kennynguyeenx\LibraryHexagonal\Infrastructure
 */
class BorrowingDomainConfig
{
    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return [
            BorrowingDatabase::class => function(Application $application) {
                return $application->make(BorrowingDatabaseAdapter::class);
            },
            BorrowingEventPublisher::class => function() {
                return new KafkaBorrowingEventPublisherAdapter();
            },
        ];
    }
}
