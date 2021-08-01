<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure;

use DI\Container;
use Doctrine\ORM\EntityManager;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\AvailableBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\BorrowedBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Model\ReservedBook;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Outgoing\BorrowingDatabase;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Core\Ports\Outgoing\BorrowingEventPublisher;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure\AvailableBookRepository;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure\BorrowedBookRepository;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure\BorrowingDatabaseAdapter;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure\KafkaBorrowingEventPublisherAdapter;
use Kennynguyeenx\LibraryHexagonal\Domain\Borrowing\Infrastructure\ReservedBookRepository;
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
            }),
            AvailableBookRepository::class => factory(function (Container $c) {
                /** @var EntityManager $em */
                $em = $c->get('em');
                return $em->getRepository(AvailableBook::class);
            }),
            BorrowedBookRepository::class => factory(function (Container $c) {
                /** @var EntityManager $em */
                $em = $c->get('em');
                return $em->getRepository(BorrowedBook::class);
            }),
            ReservedBookRepository::class => factory(function (Container $c) {
                /** @var EntityManager $em */
                $em = $c->get('em');
                return $em->getRepository(ReservedBook::class);
            }),
        ];
    }
}
