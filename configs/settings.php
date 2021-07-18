<?php

declare(strict_types=1);

use Monolog\Logger;

return [
    'settings.app.name' => getenv('APP_NAME'),
    'settings.responseChunkSize' => 4096,
    'settings.outputBuffering' => 'append',
    'settings.determineRouteBeforeAppMiddleware' => getenv('APP_DETERMINE_ROUTE_BEFORE_APP_MIDDLEWARE'),
    'settings.displayErrorDetails' => getenv('APP_DISPLAY_ERROR_DETAILS'),

    'config' => [
        'doctrine' => [
            'proxy' => [
                'path' => ROOT_FOLDER . 'data/doctrine/proxies'
            ],
            'cache' => [
                'path' => ROOT_FOLDER . 'data/cache/doctrine'
            ],
            'mysql' => [
                'host' => getenv('DB_MYSQL_HOST'),
                'database' => getenv('DB_MYSQL_DATABASE'),
                'username' => getenv('DB_MYSQL_USERNAME'),
                'password' => getenv('DB_MYSQL_PASSWORD'),
                'charset' => getenv('DB_MYSQL_CHARSET')
            ]
        ],
        'redis_cluster' => [
            'host_array' => explode(',', getenv('REDIS_HOST_ARRAY')),
            'password' => getenv('REDIS_PASSWORD'),
            'name_space' => getenv('REDIS_NAME_SPACE')
        ],
    ],
    'custom_settings' => [
        // Monolog settings
        'logger' => [
            'name' => getenv('APP_NAME'),
            'path' => 'php://stdout',
            'level' => Logger::DEBUG,
        ],
    ],
];
