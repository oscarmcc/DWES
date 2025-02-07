<?php

require_once '../app/config/config.php';
require_once '../vendor/autoload.php';

use App\Controllers\IndexController;
use App\Controllers\NumerosController;
use App\Core\Router;

$router = new Router();
$router->add(
    array(
    'name' => 'home',
    'path' => '/^\/$/',
    'action' => [IndexController::class, 'IndexAction'],
    )
);

$router -> add(
    array(
        'name' => 'home',
            'path' => '/^\/saludo\/([a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_-]+)$/',
            'action' => [IndexController::class, 'saludaAction'],
    )
    );

    $router -> add(
        array(
            'name' => 'home',
                'path' => '/^\/pares\/?$/',
                'action' => [NumerosController::class, 'paresAction'],
        )
        );
$request = str_replace(DIRBASEURL, '', $_SERVER['REQUEST_URI']);
echo ($request);
$route = $router->match($request);
if ($route) {
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
} else {
    echo "No route";
}