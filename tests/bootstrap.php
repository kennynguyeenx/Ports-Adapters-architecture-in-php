<?php

declare(strict_types=1);

use Dotenv\Dotenv;

require __DIR__ . "/../vendor/autoload.php";

$dotEnv = Dotenv::createImmutable(dirname(__DIR__), '.env.testing');
$dotEnv->load();
