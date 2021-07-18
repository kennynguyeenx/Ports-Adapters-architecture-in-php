<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\EmailDatabase;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Ports\EmailSender;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Infrastructure\EmailDatabaseAdapter;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Infrastructure\SendGridEmailSender;

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
            EmailDatabase::class => function(Application $application) {
                return $application->make(EmailDatabaseAdapter::class);
            },
            EmailSender::class => function() {
                return new SendGridEmailSender(getenv("SENDGRID_API_KEY"));
            }
        ];
    }
}
