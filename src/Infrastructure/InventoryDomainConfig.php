<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\EmailDatabase;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\EmailSender;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Infrastructure\EmailDatabaseAdapter;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Infrastructure\SendGridEmailSender;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\GetBookDetails;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\InventoryDatabase;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\InventoryEventPublisher;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Infrastructure\GoogleBooksAdapter;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Infrastructure\InventoryDatabaseAdapter;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Infrastructure\KafkaInventoryEventPublisherAdapter;

/**
 * Class InventoryDomainConfig
 * @package Kennynguyeenx\LibraryHexagonal\Infrastructure
 */
class InventoryDomainConfig
{
    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return [
            GetBookDetails::class => function(Application $application) {
                return $application->make(GoogleBooksAdapter::class);
            },
            InventoryDatabase::class => function(Application $application) {
                return $application->make(InventoryDatabaseAdapter::class);
            },
            InventoryEventPublisher::class => function(Application $application) {
                return $application->make(KafkaInventoryEventPublisherAdapter::class);
            }
        ];
    }
}
