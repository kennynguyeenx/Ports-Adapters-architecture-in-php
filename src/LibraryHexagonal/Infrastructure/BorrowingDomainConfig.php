<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure;

use DI\Container;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Outgoing\BorrowingDatabase;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Outgoing\BorrowingEventPublisher;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure\BorrowingDatabaseAdapter;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure\KafkaBorrowingEventPublisherAdapter;
use function DI\factory;

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
            BorrowingDatabase::class => factory(function (Container $c) {
                return $c->make(BorrowingDatabaseAdapter::class);
            }),
            BorrowingEventPublisher::class => factory(function (Container $c) {
                return $c->make(KafkaBorrowingEventPublisherAdapter::class);
            })
        ];
    }
}
