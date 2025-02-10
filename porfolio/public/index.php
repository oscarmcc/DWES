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
use App\Controllers\MostrarController;
use App\Controllers\SesionController;
use App\Controllers\SetController;
use App\Controllers\VisibilizarController;
use App\Controllers\ModificarController;
use App\Controllers\EliminarController;

define("DIRBASEURL", "/porfolio/public/index.php");
define("DIRPUBLIC", "/porfolio/public/");

$router = new Router();

$router->add(array(
    'name'=>'primera',
    'path'=>'/^\/$/',
    'action'=>[MostrarController::class, 'indexAction'],
    'roles'=>['invitado', 'user']
));

$router->add(array(
    'name'=>'login',
    'path'=>'/^\/login\/$/',
    'action'=>[SesionController::class, 'loginAction'],
    'roles'=>['invitado']
));

$router->add(array(
    'name'=>'Registro',
    'path'=>'/^\/registro\/$/',
    'action'=>[SesionController::class, 'registrerAction'],
    'roles'=>['invitado']
));

$router->add(array(
    'name'=>'Logout',
    'path'=>'/^\/logout\/$/',
    'action'=>[SesionController::class, 'logoutAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'miperfil',
    'path'=>'/^\/perfil\/$/',
    'action'=>[MostrarController::class, 'perfilAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'modificar',
    'path'=>'/^\/modificarusuario\/$/',
    'action'=>[ModificarController::class, 'modificarUsuarioAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'visible',
    'path'=>'/^\/visible\/$/',
    'action'=>[VisibilizarController::class, 'visibleAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'no_visible',
    'path'=>'/^\/novisible\/$/',
    'action'=>[VisibilizarController::class, 'novisibleAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'eliminar',
    'path'=>'/^\/eliminarusuario\/$/',
    'action'=>[EliminarController::class, 'eliminarUsuarioAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'settrabajo',
    'path'=>'/^\/settrabajo\/$/',
    'action'=>[SetController::class, 'setTrabajoAction'],
    'roles'=>['user']
));
$router->add(array(
    'name'=>'setredes',
    'path'=>'/^\/setredes\/$/',
    'action'=>[SetController::class, 'setRedesAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'setproyectos',
    'path'=>'/^\/setproyectos\/$/',
    'action'=>[SetController::class, 'setProyectosAction'],
    'roles'=>['user']
));
$router->add(array(
    'name'=>'setskills',
    'path'=>'/^\/setskills\/$/',
    'action'=>[SetController::class, 'setSkillsAction'],
    'roles'=>['user']
));


$router->add(array(
    'name'=>'visibilizarSkill',
    'path'=>'/^\/visibilizarSkill\/\d+$/',
    'action'=>[VisibilizarController::class, 'visibleSkillAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'visibilizarProyecto',
    'path'=>'/^\/visibilizarProyecto\/\d+$/',
    'action'=>[VisibilizarController::class, 'visibleProyectoAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'visibilizarTrabajo',
    'path'=>'/^\/visibilizarTrabajo\/\d+$/',
    'action'=>[VisibilizarController::class, 'visibleTrabajoAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'modificarRed',
    'path'=>'/^\/modificarRed\/\d+$/',
    'action'=>[ModificarController::class, 'modificarRedAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'modificarSkill',
    'path'=>'/^\/modificarSkill\/\d+$/',
    'action'=>[ModificarController::class, 'modificarSkillAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'modificarProyecto',
    'path'=>'/^\/modificarProyecto\/\d+$/',
    'action'=>[ModificarController::class, 'modificarProyectoAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'modificarTrabajo',
    'path'=>'/^\/modificarTrabajo\/\d+$/',
    'action'=>[ModificarController::class, 'modificarTrabajoAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'eliminarRed',
    'path'=>'/^\/eliminarRed\/\d+$/',
    'action'=>[EliminarController::class, 'eliminarRedAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'eliminarSkill',
    'path'=>'/^\/eliminarSkill\/\d+$/',
    'action'=>[EliminarController::class, 'eliminarSkillAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'eliminarProyecto',
    'path'=>'/^\/eliminarProyecto\/\d+$/',
    'action'=>[EliminarController::class, 'eliminarProyectoAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'eliminarTrabajo',
    'path'=>'/^\/eliminarTrabajo\/\d+$/',
    'action'=>[EliminarController::class, 'eliminarTrabajoAction'],
    'roles'=>['user']
));

$router->add(array(
    'name'=>'verusuario',
    'path'=>'/^\/verperfil\/\d+$/',
    'action'=>[MostrarController::class, 'verPerfilAction'],
    'roles'=>['user', 'invitado']
));


$request = str_replace(DIRBASEURL, '', $_SERVER['REQUEST_URI']);
echo ($request);
$route = $router->match($request, $_SESSION['rol']);
if ($route) {
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
} else {
    echo "No route";
    var_dump($route);
}
?>