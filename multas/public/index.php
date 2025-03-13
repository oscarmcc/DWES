<?php
session_start();
require_once "../bootstrap.php";
require_once "../vendor/autoload.php";


use App\Controllers\UsuariosController;
use App\Core\Router;
use App\Controllers\IndexController;
use App\Controllers\MultasController;

// Si no hay una sesión iniciada, se establece el rol como 'invitado'
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = '';
    $_SESSION['rol'] = 'invitado';
}

$router = new Router();


// Se definen las rutas de la aplicación
$router->add([
    'name' => 'index',
    'path' => '/^\/$/',
    'action' => [IndexController::class, 'IndexAction'],
    'rol' => ['invitado', 'admin', 'agente', 'conductor']
]);


// Rutas para el logout
$router->add([
    'name' => 'logout',
    'path' => '/^\/logout\/$/',
    'action' => [UsuariosController::class, 'logoutAction'],
    'rol' => ['admin', 'agente', 'conductor']
]);

// Rutas para el perfil conductor
$router->add([
    'name' => 'perfilconductor',
    'path' => '/^\/perfil\/$/',
    'action' => [UsuariosController::class, 'verMultasAction'],
    'rol' => ['conductor']
]);

// Rutas para el perfil agente

$router->add([
    'name' => 'perfilagente',
    'path' => '/^\/perfilagente\/$/',
    'action' => [UsuariosController::class, 'verMultasAgenteAction'],
    'rol' => ['agente']
]);

// Ruta para pagar las multas

$router->add([
    'name' => 'pagarmultas',
    'path' => '/^\/pagarmultas\/\d+$/',
    'action' => [MultasController::class, 'pagarMultasAction'],
    'rol' => ['conductor']
]);

// Ruta para añadir multas
$router->add([
    'name' => 'addmultas',
    'path' => '/^\/addmultas\/$/',
    'action' => [MultasController::class, 'addMultasAction'],
    'rol' => ['agente']
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