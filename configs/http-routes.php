<?php

declare(strict_types=1);

/** @var $app */
$app->group('/api/v1/user', function () use ($app) {
    $app->post('[/]', ['Api\V1\UserController', 'add']);
});
