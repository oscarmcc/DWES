<?php
namespace App\Controllers;

use App\Models\Usuarios;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class UserController
{

    private $requestMethod;
    private $usuarios;
    private $usuariosId;

    public function __construct($requestMethod, $usuariosId)
    {
        $this->requestMethod = $requestMethod;
        $this->usuariosId = $usuariosId;
        $this->usuarios = Usuarios::getInstancia();
    }

    public function processRequest(){

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);

        switch($this->requestMethod){
            case 'GET':
                $response = $this->getUsuario();
                break;

            case 'POST':
                if (isset($uri[3]) && $uri[3] === 'refresh') {
                    $response = $this->refreshToken();
                } else {
                    $response = $this->registerUsuario();
                }
                break;

            case 'PUT':
                $response = $this->updateUsuario();
                break;

            case 'DELETE':
                $response = $this->deleteUsuario();
                break;
                
            default:
                $response = $this->notFoundResponse();
                break;
        }

        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getUsuario(){
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        if(empty($input)){
            $usuarios = $this->usuarios->getAll();
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = json_encode($usuarios);
            return $response;
        }else{
            $user = $this->usuarios->get($input);
            if (!$user) {
                return $this->unprocessableEntityResponse('Usuario no encontrado', 'HTTP/1.1 404 Not Found');
            }else{
                $response['status_code_header'] = 'HTTP/1.1 200 OK';
                $response['body'] = json_encode($user);
                return $response;
            }
        }
    }

    private function registerUsuario(){
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        if (!$this->validateUsuario($input)) {
            return $this->unprocessableEntityResponse('Datos inválidos', 'HTTP/1.1 400 Bad Request');
        }

        $user_exists = $this->usuarios->get(['email' => $input['email']]);
        if ($user_exists) {
            return $this->unprocessableEntityResponse('El email ya está registrado','HTTP/1.1 409 Conflict');
        }else{
            $this->usuarios->set($input);

            $response['status_code_header'] = 'HTTP/1.1 201 Created';
            $response['body'] = json_encode(['message' => 'Usuario registrado']);
            return $response;
        }

    }

    private function updateUsuario(){
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $jwt = explode(" ", $authHeader)[1] ?? null;

        try {
            $decoded = JWT::decode($jwt, new Key(KEY, 'HS256'));
            $idUser = $decoded->data->{0} ?? null;

        } catch (Exception $e) {
            return $this->unprocessableEntityResponse("Acceso denegado", 'HTTP/1.1 401 Unauthorized');
        }

        $user = $this->usuarios->get(['email' => $input['email']]);
        if (!$user) {
            return $this->unprocessableEntityResponse('Usuario no encontrado', 'HTTP/1.1 404 Not Found');
        }

        if (!$this->validateUsuario($input)) {
            return $this->unprocessableEntityResponse('Datos inválidos', 'HTTP/1.1 400 Bad Request');
        }

        $input['id'] = $idUser;
        $this->usuarios->edit($input);

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(['message' => 'Usuario actualizado']);
        return $response;
    }

    private function deleteUsuario()
    {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $jwt = explode(" ", $authHeader)[1] ?? null;

        try {
            $decoded = JWT::decode($jwt, new Key(KEY, 'HS256'));
            $idUser = $decoded->data->{0} ?? null;

        } catch (Exception $e) {
            return $this->unprocessableEntityResponse("Acceso denegado", 'HTTP/1.1 401 Unauthorized');
        }

        $this->usuarios->delete(['id' => $idUser]);
        
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(['message' => 'Usuario eliminado']);
            return $response;
    }

    private function refreshToken(){
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $jwt = explode(" ", $authHeader)[1] ?? null;

        try {
            $decoded = JWT::decode($jwt, new Key(KEY, 'HS256'));

        } catch (Exception $e) {
            return $this->unprocessableEntityResponse("Acceso denegado", 'HTTP/1.1 401 Unauthorized');
        }

        $user = $this->usuarios->get($input);
        if (!$user) {
            return $this->unprocessableEntityResponse('Usuario no encontrado', 'HTTP/1.1 404 Not Found');
        }

        $token = [
            'iat' => time(),
            'exp' => time() + 3600,
            'data' => [
                $user['id'],
                $user['email']
            ]
        ];

        // Generar un nuevo token
        $key = KEY; // Clave de encriptación
        $issuer_claim = "http://centroscivicos.local"; // Emisor del token
        $audience_claim = "http://centroscivicos.local"; // Destinatario del token
        $issuedat_claim = time(); // Tiempo en que fue emitido el token
        $notbofore_claim = time(); // Tiempo antes del cual no es válido el token
        $expire_claim = $issuedat_claim + 3600; // Tiempo de expiración del token

        $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbofore_claim,
            "exp" => $expire_claim,
            "data" => $decoded->data
        );

        $jwt = JWT::encode($token, $key, 'HS256');
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(
            array(
                "message" => "Token renovado con éxito.",
                "jwt" => $jwt,
                "expireAt" => $expire_claim
            )
        );

        return $response;
    }

    private function validateUsuario($input){
        if (!isset($input['email']) || !isset($input['passwd'])) {
            return false;
        }
        return true;
    }

    private function unprocessableEntityResponse($message = 'Datos inválidos', $error){
        $response['status_code_header'] = $error;
        $response['body'] = json_encode(['error' => $message]);
        return $response;
    }

    private function notFoundResponse(){
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = json_encode(['error' => 'Recurso no encontrado']);
        return $response;
    }
}
?>