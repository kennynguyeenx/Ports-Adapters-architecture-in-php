<?php

declare(strict_types=1);

use Slim\App;

require dirname(__DIR__) . '/init.php';

/** @var App $app */
$app = require ROOT_FOLDER . '/bootstrap/http/application.php';

$app->run();
