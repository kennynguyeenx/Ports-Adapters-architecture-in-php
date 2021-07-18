<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Infrastructure;

use DI\Container;
use Kennynguyeenx\LibraryHexagonal\Application\Http\Controller\Api\V1\UserController;
use Kennynguyeenx\LibraryHexagonal\Application\Http\Response\ResponseHelper;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Application\UserCommandController;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Ports\Incoming\AddNewUser;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\UserFacade;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Log\LoggerInterface;
use function DI\factory;

/**
 * Class LibraryHexagonalConfig
 * @package Kennynguyeenx\LibraryHexagonal\Infrastructure
 */
class LibraryHexagonalConfig
{
    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return [
            LoggerInterface::class => factory(function (Container $c) {
                $settings = (array)$c->get('custom_settings')['logger'];
                $logger = new Logger($settings['name'] . '.PHP');
                $logger->pushProcessor(new UidProcessor());
                $logger->pushHandler(new StreamHandler($settings['path'], $settings['level']));
                return $logger;
            }),
            'Api\V1\UserController' => factory(function (Container $c) {
                return new UserController(
                    $c->make(LoggerInterface::class),
                    $c->make(ResponseHelper::class),
                    $c->make(UserCommandController::class)
                );
            }),
        ];
    }
}
