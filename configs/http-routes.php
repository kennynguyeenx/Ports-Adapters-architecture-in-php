<?php

declare(strict_types=1);

use Slim\App;
use Slim\Http\Response;

/** @var App $app */
$app->group('/api/v1/users', function () use ($app) {
    $app->post('[/]', ['Api\V1\UserController', 'add']);
});

$app->get('/', function (Response $response) use ($app) {
    return $response->withJson('ok');
});