<?php

declare(strict_types=1);

use Slim\App;
use Slim\Http\Response;

/** @var App $app */
$app->post('/api/v1/users[/]', ['Api\V1\UserController', 'add']);

$app->get('/', function (Response $response) use ($app) {
    return $response->withJson('ok');
});