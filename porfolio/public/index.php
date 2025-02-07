<?php
// Iniciamos la sesión  y le asignamos un valor a $_SESSION['id'] como vacío para que se comparta con todas las páginas
session_start();

// Asegurar que $_SESSION['id'] está definida
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = "";
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
    'action'=>[MostrarController::class, 'indexAction']
));

$router->add(array(
    'name'=>'login',
    'path'=>'/^\/login\/$/',
    'action'=>[SesionController::class, 'loginAction']
));

$router->add(array(
    'name'=>'Registro',
    'path'=>'/^\/registro\/$/',
    'action'=>[SesionController::class, 'registrerAction']
));

$router->add(array(
    'name'=>'Logout',
    'path'=>'/^\/logout\/$/',
    'action'=>[SesionController::class, 'logoutAction']
));

$router->add(array(
    'name'=>'miperfil',
    'path'=>'/^\/perfil\/$/',
    'action'=>[MostrarController::class, 'perfilAction']
));

$router->add(array(
    'name'=>'modificar',
    'path'=>'/^\/modificarusuario\/$/',
    'action'=>[ModificarController::class, 'modificarUsuarioAction']
));

$router->add(array(
    'name'=>'visible',
    'path'=>'/^\/visible\/$/',
    'action'=>[VisibilizarController::class, 'visibleAction']
));

$router->add(array(
    'name'=>'no_visible',
    'path'=>'/^\/novisible\/$/',
    'action'=>[VisibilizarController::class, 'novisibleAction']
));

$router->add(array(
    'name'=>'eliminar',
    'path'=>'/^\/eliminarusuario\/$/',
    'action'=>[EliminarController::class, 'eliminarUsuarioAction']
));

$router->add(array(
    'name'=>'settrabajo',
    'path'=>'/^\/settrabajo\/$/',
    'action'=>[SetController::class, 'setTrabajoAction']
));
$router->add(array(
    'name'=>'setredes',
    'path'=>'/^\/setredes\/$/',
    'action'=>[SetController::class, 'setRedesAction']
));

$router->add(array(
    'name'=>'setproyectos',
    'path'=>'/^\/setproyectos\/$/',
    'action'=>[SetController::class, 'setProyectosAction']
));
$router->add(array(
    'name'=>'setskills',
    'path'=>'/^\/setskills\/$/',
    'action'=>[SetController::class, 'setSkillsAction']
));


$router->add(array(
    'name'=>'visibilizarSkill',
    'path'=>'/^\/visibilizarSkill\/\d+$/',
    'action'=>[VisibilizarController::class, 'visibleSkillAction']
));

$router->add(array(
    'name'=>'visibilizarProyecto',
    'path'=>'/^\/visibilizarProyecto\/\d+$/',
    'action'=>[VisibilizarController::class, 'visibleProyectoAction']
));

$router->add(array(
    'name'=>'visibilizarTrabajo',
    'path'=>'/^\/visibilizarTrabajo\/\d+$/',
    'action'=>[VisibilizarController::class, 'visibleTrabajoAction']
));

$router->add(array(
    'name'=>'modificarRed',
    'path'=>'/^\/modificarRed\/\d+$/',
    'action'=>[ModificarController::class, 'modificarRedAction']
));

$router->add(array(
    'name'=>'modificarSkill',
    'path'=>'/^\/modificarSkill\/\d+$/',
    'action'=>[ModificarController::class, 'modificarSkillAction']
));

$router->add(array(
    'name'=>'modificarProyecto',
    'path'=>'/^\/modificarProyecto\/\d+$/',
    'action'=>[ModificarController::class, 'modificarProyectoAction']
));

$router->add(array(
    'name'=>'modificarTrabajo',
    'path'=>'/^\/modificarTrabajo\/\d+$/',
    'action'=>[ModificarController::class, 'modificarTrabajoAction']
));

$router->add(array(
    'name'=>'eliminarRed',
    'path'=>'/^\/eliminarRed\/\d+$/',
    'action'=>[EliminarController::class, 'eliminarRedAction']
));

$router->add(array(
    'name'=>'eliminarSkill',
    'path'=>'/^\/eliminarSkill\/\d+$/',
    'action'=>[EliminarController::class, 'eliminarSkillAction']
));

$router->add(array(
    'name'=>'eliminarProyecto',
    'path'=>'/^\/eliminarProyecto\/\d+$/',
    'action'=>[EliminarController::class, 'eliminarProyectoAction']
));

$router->add(array(
    'name'=>'eliminarTrabajo',
    'path'=>'/^\/eliminarTrabajo\/\d+$/',
    'action'=>[EliminarController::class, 'eliminarTrabajoAction']
));

$router->add(array(
    'name'=>'verusuario',
    'path'=>'/^\/verperfil\/\d+$/',
    'action'=>[MostrarController::class, 'verPerfilAction']
));


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
?>