<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure;

use DI\Container;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\GetBookDetails;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\InventoryDatabase;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\InventoryEventPublisher;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Infrastructure\GoogleBooksAdapter;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Infrastructure\InventoryDatabaseAdapter;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Infrastructure\KafkaInventoryEventPublisherAdapter;
use function DI\factory;

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
            GetBookDetails::class => factory(function(Container $container) {
                return $container->make(GoogleBooksAdapter::class);
            }),
            InventoryDatabase::class => factory(function(Container $container) {
                return $container->make(InventoryDatabaseAdapter::class);
            }),
            InventoryEventPublisher::class => factory(function(Container $container) {
                return $container->make(KafkaInventoryEventPublisherAdapter::class);
            })
        ];
    }
}
