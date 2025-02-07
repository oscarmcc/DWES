<?php
require "../boostrap.php";
use App\Controllers\ContactosController;
use App\Controllers\AuthController;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use App\Core\Router;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE"); 

// Esto es de angular entrecomillado por que no se si es necesario
// $method = $_SERVER['REQUEST_METHOD'];
// if($method == "OPTIONS") {
//     die();
// }

// Recuperamos el método utilizado
$requestMethod = $_SERVER['REQUEST_METHOD'];
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $request );

$userId = null;
if(isset($uri[2])) {
    $userId = $uri[2];
}

$router = new Router();
$router->add(array(
    'name' => 'home',
    'path' => '/^\/contactos\/([0-9]+)?$/',
    'action' => ContactosController::class)
);

if($request == '/login/'){
    $auth = new AuthController($requestMethod);
    if (!$auth->LoginFromRequest()){
        exit(http_response_code(401));
    }
}

$input = (array) json_decode(file_get_contents('php://input'), TRUE);
$autHeader = $_SERVER['HTTP_AUTHORIZATION'];
$arr = explode(" ", $autHeader);
$jwt = $arr[1];

// var_dump($_SERVER);
// exit;
if($jwt){
    try{
        $decoded = JWT::decode($jwt, new Key(KEY, 'HS256'));
    }catch(Exception $e){
        echo json_encode(
            array(
                "message" => "Acceso denegado",
                "error" => $e->getMessage()
            )
        );
        exit(http_response_code(401));
    }
}

$router = $router->match($request);
if($router){
    $controllerName = $router['action'];
    $controller = new $controllerName($requestMethod, $userId);
    $controller->processRequest();
}else{

    $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
    $response['body']= null;
    echo json_encode($response);
}
?>