<?php
require_once "../bootstrap.php";
require_once "../vendor/autoload.php";

use App\Core\Router;
use App\Controllers\CentrosCivicosController;
use App\Controllers\InstalacionesController;
use App\Controllers\ActividadesController;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE"); 

$requestMethod = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_METHOD'];

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $request );

$userId = null;
if(isset($uri[3])){
    $userId = (int) $uri[3];
}


$router = new Router();

// CONSULTAS PARA CENTROS CIVICOS

$router->add(array(
    'name'=>'centros',
    'path'=>'/^\/api\/centros$/',
    'action'=> CentrosCivicosController::class,
    'perfil'=>  ['publico']
));

$router->add(array(
    'name'=>'centro',
    'path'=>'/^\/api\/centros\/[0-9]+$/',
    'action'=> CentrosCivicosController::class,
    'perfil'=>  ['publico']
));   

// CONSULTAS PARA INSTALACIONES

$router->add(array(
    'name'=>'instalaciones',
    'path'=>'/^\/api\/instalaciones$/',
    'action'=> InstalacionesController::class,
    'perfil'=>  ['publico']
));

$router->add(array(
    'name'=>'instalacion',
    'path'=>'/^\/api\/centros\/[0-9]+\/instalaciones$/',
    'action'=> InstalacionesController::class,
    'perfil'=>  ['publico']
));

// CONSULTAS PARA ACTIVIDADES

$router->add(array(
    'name'=>'actividades',
    'path'=>'/^\/api\/actividades$/',
    'action'=> ActividadesController::class,
    'perfil'=>  ['publico']
));

$router->add(array(
    'name'=>'actividad',
    'path'=>'/^\/api\/centros\/[0-9]+\/actividades$/',
    'action'=> ActividadesController::class,
    'perfil'=>  ['publico']
));

$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request);

if($route){
    $controllerName = $route['action'];
    $controller = new $controllerName($requestMethod, $userId);
    $controller->processRequest();
}else{
    echo "No route";
}
?>
