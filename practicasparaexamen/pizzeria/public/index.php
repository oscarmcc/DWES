<?php

use App\Controllers\IndexController;
use App\Controllers\AuthController;
use App\Controllers\PizzaController;
use App\Core\Router;
session_start();
require_once "../bootstrap.php";
require_once "../vendor/autoload.php";


// Si no hay una sesión iniciada, se establece el rol como 'invitado'
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = '';
    $_SESSION['rol'] = 'invitado';
}

$router = new Router();

$router->add([
    'name' => 'index',
    'path' => '/^\/$/',
    'action' => [IndexController::class, 'IndexAction'],
    'rol' => ['invitado', 'cliente']
]);
$router->add([
    'name' => 'index',
    'path' => '/^\/registro\/$/',
    'action' => [AuthController::class, 'registroAction'],
    'rol' => ['invitado']
]);

$router->add([
    'name' => 'index',
    'path' => '/^\/login\/$/',
    'action' => [AuthController::class, 'loginAction'],
    'rol' => ['invitado']
]);

$router->add([
    'name' => 'index',
    'path' => '/^\/logout\/$/',
    'action' => [AuthController::class, 'logoutAction'],
    'rol' => ['cliente']
]);

$router->add([
    'name' => 'index',
    'path' => '/^\/eliminarusuario\/$/',
    'action' => [AuthController::class, 'eliminarUsuarioAction'],
    'rol' => ['cliente']
]);

$router->add([
    'name' => 'index',
    'path' => '/^\/pizzas\/$/',
    'action' => [PizzaController::class, 'verPizzasAction'],
    'rol' => ['cliente']
]);

// Limpia la ruta de petición
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Busca la ruta solicitada 
$route = $router->match($request);

// Si la ruta existe y el rol del usuario es permitido, se ejecuta la acción correspondiente
if ($route) {
    if (isset($route['rol']) && !in_array($_SESSION['rol'], $route['rol'])) {
        header("Location: /");
    } else {
        $controllerName = $route['action'][0];
        $actionName = $route['action'][1];
        $controller = new $controllerName;
        $controller->$actionName($request);
    }
} else {
    echo "No route";
}
?>