<?php
require_once "../vendor/autoload.php";
require_once "../bootstrap.php";

use App\Controllers\AdminController;
use App\Controllers\BlogController;
use App\Controllers\IndexController;
use Aura\Router\RouterContainer as router;
use App\Controllers\UserController;
use App\Controllers\AuthController;
use Symfony\Component\VarDumper\VarDumper;

// session_start();

// if (!isset($_SESSION['perfil'])) {
//     $_SESSION['user'] = 'Invitado';
//     $_SESSION['perfil'] = "Invitado";
// }

$request = \Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$router = new Router();
$rutas = $router->getMap();
$rutas->get("Inicio", "/", [IndexController::class, "indexAction"]);
$rutas->get("Mostrar el añadir blog", "/blog", [BlogController::class, "blogsAction"]);
$rutas->post("Accion de añadir blog", "/blog", [BlogController::class, "blogsAction", 'auth' => true]);
$rutas->post("addUser", "/register", [UserController::class, "userAction"]);
$rutas->get("formuser", "/register", [UserController::class, "userAction"]);
$rutas->post("Accion de iniciar sesión", "/login", [AuthController::class, "loginAction"]);
$rutas->get("Mostrar el iniciar sesión", "/login", [AuthController::class, "loginAction"]);
$rutas->get("admin", "/admin", [IndexController::class, "adminAction", 'auth' => true]);
$rutas->get("Cerrar sesión", "/logout", [AuthController::class, "logoutAction", 'auth' => true]);
$rutas->get("Mostrar el sobre la web", "/about", [IndexController::class, "aboutAction"]);
$rutas->get("Mostrar el contacto de la web", "/contactos", [IndexController::class, "contactAction"]);
$rutas->get("Mostrar detalles del blog", "/showPost", [BlogController::class, "showPostAction"]);
$rutas->post("Agregar comentario", "/postComment", [BlogController::class, "addCommentAction"]);


$route = $router->getMatcher()->match($request);

if (!$route) {
    exit(http_response_code(404));
}

var_dump($_SESSION['perfil']);

$handler = $route->handler;
$needsAuth = $handler['auth'] ?? false;

// Si la ruta necesita autenticación y el usuario no está logeado, redirigir al login
if ($needsAuth && ($_SESSION['perfil'] ?? 'invitado') === "invitado") {
    header("Location: /login");
    exit;
}

$controller = new $handler[0];
$action = $handler[1];
$response = $controller->$action($request);
echo $response->getBody();
