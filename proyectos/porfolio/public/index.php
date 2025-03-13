<?php
// Iniciamos la sesión  y le asignamos un valor a $_SESSION['id'] como vacío para que se comparta con todas las páginas
session_start();

// Asegurar que $_SESSION['id'] está definida
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = "";
    $_SESSION['rol'] = "invitado";
}
// requerimos el boostrap y autoload
require_once "../boostrap.php";
require_once "../vendor/autoload.php";

use App\Core\Router;
use App\Controllers\IndexController;
use App\Controllers\UsuarioController;
use App\Controllers\SkillsController;
use App\Controllers\TrabajoController;
use App\Controllers\ProyectosController;
use App\Controllers\RedesController;

define("DIRBASEURL", "/porfolio/public/index.php");
define("DIRPUBLIC", "/porfolio/public/");

$router = new Router();

// Rutas inicial y ver perfil
$router->add(array(
    'name' => 'primera',
    'path' => '/^\/(\?.*)?$/',
    'action' => [IndexController::class, 'indexAction'],
    'roles' => ['invitado', 'user']
));

$router->add(array(
    'name' => 'verusuario',
    'path' => '/^\/verperfil\/\d+$/',
    'action' => [IndexController::class, 'verPerfilAction'],
    'roles' => ['user', 'invitado']
));

// Rutas del usuario
$router->add(array(
    'name' => 'login',
    'path' => '/^\/login\/$/',
    'action' => [UsuarioController::class, 'loginAction'],
    'roles' => ['invitado']
));

$router->add(array(
    'name' => 'Registro',
    'path' => '/^\/registro\/$/',
    'action' => [UsuarioController::class, 'registrerAction'],
    'roles' => ['invitado']
));
$router->add([
    'name' => 'Para verfificar la cuenta',
    'path' => '/^\/verificacion\/.*$/',
    'action' => [UsuarioController::class, 'verificarAction'],
    'roles' => ['invitado']
]);

$router->add(array(
    'name' => 'Logout',
    'path' => '/^\/logout\/$/',
    'action' => [UsuarioController::class, 'logoutAction'],
    'roles' => ['user']
));

$router->add(array(
    'name' => 'miperfil',
    'path' => '/^\/perfil\/$/',
    'action' => [UsuarioController::class, 'perfilAction'],
    'roles' => ['user']
));

$router->add(array(
    'name' => 'modificar',
    'path' => '/^\/modificarusuario\/$/',
    'action' => [UsuarioController::class, 'modificarUsuarioAction'],
    'roles' => ['user']
));

$router->add(array(
    'name' => 'visible',
    'path' => '/^\/visibilizarPerfil\/$/',
    'action' => [UsuarioController::class, 'visibilizarAction'],
    'roles' => ['user']
));


$router->add(array(
    'name' => 'eliminar',
    'path' => '/^\/eliminarusuario\/$/',
    'action' => [UsuarioController::class, 'eliminarUsuarioAction'],
    'roles' => ['user']
));

// Rutas para los trabajos
$router->add(array(
    'name' => 'settrabajo',
    'path' => '/^\/settrabajo\/$/',
    'action' => [TrabajoController::class, 'setTrabajoAction'],
    'roles' => ['user']
));

$router->add(array(
    'name' => 'visibilizarTrabajo',
    'path' => '/^\/visibilizarTrabajo\/\d+$/',
    'action' => [TrabajoController::class, 'visibleTrabajoAction'],
    'roles' => ['user']
));

$router->add(array(
    'name' => 'modificarTrabajo',
    'path' => '/^\/modificarTrabajo\/\d+$/',
    'action' => [TrabajoController::class, 'modificarTrabajoAction'],
    'roles' => ['user']
));

$router->add(array(
    'name' => 'eliminarTrabajo',
    'path' => '/^\/eliminarTrabajo\/\d+$/',
    'action' => [TrabajoController::class, 'eliminarTrabajoAction'],
    'roles' => ['user']
));

// Rutas de redes
$router->add(array(
    'name' => 'setredes',
    'path' => '/^\/setredes\/$/',
    'action' => [RedesController::class, 'setRedesAction'],
    'roles' => ['user']
));

$router->add(array(
    'name' => 'modificarRed',
    'path' => '/^\/modificarRed\/\d+$/',
    'action' => [RedesController::class, 'modificarRedAction'],
    'roles' => ['user']
));

$router->add(array(
    'name' => 'eliminarRed',
    'path' => '/^\/eliminarRed\/\d+$/',
    'action' => [RedesController::class, 'eliminarRedAction'],
    'roles' => ['user']
));

// Rutas de Proyectos
$router->add(array(
    'name' => 'setproyectos',
    'path' => '/^\/setproyectos\/$/',
    'action' => [ProyectosController::class, 'setProyectosAction'],
    'roles' => ['user']
));

$router->add(array(
    'name' => 'visibilizarProyecto',
    'path' => '/^\/visibilizarProyecto\/\d+$/',
    'action' => [ProyectosController::class, 'visibleProyectoAction'],
    'roles' => ['user']
));

$router->add(array(
    'name' => 'modificarProyecto',
    'path' => '/^\/modificarProyecto\/\d+$/',
    'action' => [ProyectosController::class, 'modificarProyectoAction'],
    'roles' => ['user']
));

$router->add(array(
    'name' => 'eliminarProyecto',
    'path' => '/^\/eliminarProyecto\/\d+$/',
    'action' => [ProyectosController::class, 'eliminarProyectoAction'],
    'roles' => ['user']
));

// Rutas de skills
$router->add(array(
    'name' => 'setskills',
    'path' => '/^\/setskills\/$/',
    'action' => [SkillsController::class, 'setSkillsAction'],
    'roles' => ['user']
));


$router->add(array(
    'name' => 'visibilizarSkill',
    'path' => '/^\/visibilizarSkill\/\d+$/',
    'action' => [SkillsController::class, 'visibleSkillAction'],
    'roles' => ['user']
));



$router->add(array(
    'name' => 'modificarSkill',
    'path' => '/^\/modificarSkill\/\d+$/',
    'action' => [SkillsController::class, 'modificarSkillAction'],
    'roles' => ['user']
));




$router->add(array(
    'name' => 'eliminarSkill',
    'path' => '/^\/eliminarSkill\/\d+$/',
    'action' => [SkillsController::class, 'eliminarSkillAction'],
    'roles' => ['user']
));



$request = str_replace(DIRBASEURL, '', $_SERVER['REQUEST_URI']);
// echo ($request);
$route = $router->match($request, $_SESSION['rol']);
if ($route) {
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
} else {
    header("location: /");
    // var_dump($route);
}
