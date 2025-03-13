<?php
// requerimos el boostrap y autoload
require_once "../boostrap.php";
require_once "../vendor/autoload.php";

use App\Core\Router;

$router = new Router();

$router->add(array(
    'name'=>'primera',
    'path'=>'/^\/$/',
    'action'=>[PerrosController::class, 'indexAction']
));

$request = $_SERVER['REQUEST_URI'];
$router = $router->match($request);

if ($route) {
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
} else {
    echo "No route";
}
?>