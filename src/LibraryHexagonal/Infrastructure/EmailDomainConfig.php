<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure;

use DI\Container;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\Outgoing\EmailDatabase;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\Outgoing\EmailSender;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Infrastructure\EmailDatabaseAdapter;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Infrastructure\SendGridEmailSender;
use function DI\factory;

/**
 * Class EmailDomainConfig
 * @package Kennynguyeenx\LibraryHexagonal\Infrastructure
 */
class EmailDomainConfig
{
    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return [
            EmailDatabase::class => factory(function(Container $container) {
                return $container->make(EmailDatabaseAdapter::class);
            }),
            EmailSender::class => factory(function() {
                return new SendGridEmailSender(getenv("SENDGRID_API_KEY"));
            })
        ];
    }
}
