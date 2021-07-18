<?php

declare(strict_types=1);

use Slim\Interfaces\RouteInterface;

$application = new Application();

/** @var array $routes */
$routes = require ROOT_FOLDER . '/configs/http-routes.php';

foreach ($routes as $route) {
    list($method, $pattern, $handler, $middlewareList) = $route;
    /** @var RouteInterface $routeInstance */
    $routeInstance = $application->$method($pattern, $handler);
    if (is_array($middlewareList)) {
        foreach ($middlewareList as $callable) {
            $callableArray = explode(':', $callable);
            $callable = $callableArray[0];
            $routeInstance->add($callable);
        }
    }
}

return $application;
