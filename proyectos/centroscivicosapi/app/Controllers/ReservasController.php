<?php
namespace App\Controllers;

use App\Models\Reservas;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class ReservasController
{

    private $requestMethod;
    private $reservas;
    private $usuariosId;

    public function __construct($requestMethod, $usuariosId)
    {
        $this->requestMethod = $requestMethod;
        $this->usuariosId = $usuariosId;
        $this->reservas = Reservas::getInstancia();
    }


    public function processRequest(){

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);

        switch($this->requestMethod){
            case 'GET':
                $response = $this->getReservas();
                break;

            case 'POST':
                $response = $this->NuevaReserva();
                break;

            case 'DELETE':
                $response = $this->deleteReserva($uri[3]);
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

    public function getReservas(){
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;

        $jwt = explode(" ", $authHeader)[1] ?? null;

        try {
            $decoded = JWT::decode($jwt, new Key(KEY, 'HS256'));
            $idUser = $decoded->data->{0} ?? null;

        } catch (Exception $e) {
            return $this->unprocessableEntityResponse("HTTP/1.1 401 Unauthorized", "Acceso denegado: ");
        }

        $data = $this->reservas->get(['user_id' => $idUser]);

        if (!$data) {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($data);
        return $response;
    }


    public function NuevaReserva(){
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;

        $jwt = explode(" ", $authHeader)[1] ?? null;

        try {
            $decoded = JWT::decode($jwt, new Key(KEY, 'HS256'));
            $idUser = $decoded->data->{0} ?? null;

        } catch (Exception $e) {
            return $this->unprocessableEntityResponse("HTTP/1.1 401 Unauthorized", "Acceso denegado: ");
        }

        if (!isset($input['nombre']) || !isset($input['telefono']) || !isset($input['email']) || !isset($input['id_instalacion']) || !isset($input['fecha_hora_inicio']) || !isset($input['fecha_hora_final']) || !isset($input['estado'])) {
            return $this->unprocessableEntityResponse("HTTP/1.1 400 Bad Request", "El nombre, telefono, email, id_instalacion, fecha_hora_inicio, fecha_hora_final y estado son obligatorios.");
        }

        if (count($input) > 7) {
            return $this->unprocessableEntityResponse("HTTP/1.1 400 Bad Request", "Solo puede escribir el nombre, telefono, email, id_instalacion, fecha_hora_inicio, fecha_hora_final y estado.");
        }

        $input['user_id'] = $idUser;

        $this->reservas->set($input);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode(['message' => 'Reserva agregada']);
        return $response;
    }

    private function deleteReserva($id = ""){
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;

        $jwt = explode(" ", $authHeader)[1] ?? null;

        try {
            $decoded = JWT::decode($jwt, new Key(KEY, 'HS256'));
            $idUser = $decoded->data->{0} ?? null;

        } catch (Exception $e) {
            return $this->unprocessableEntityResponse("HTTP/1.1 401 Unauthorized", "Acceso denegado: ");
        }
        
        $data = $this->reservas->get(['id' => $id]);
        if (!$data) {
            return $this->notFoundResponse();
        } else {
            $data = $this->reservas->delete(['id' => $id]);
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(['message' => 'Reserva eliminada']);
        return $response;
    }

    private function unprocessableEntityResponse($error, $mensaje = 'Datos no válidos') {
        $response['status_code_header'] = $error;
        $response['body'] = json_encode(['error' => $mensaje]);
        return $response;
    }

    private function notFoundResponse() {
        return [
            'status_code_header' => 'HTTP/1.1 404 Not Found',
            'body' => json_encode(['message' => 'Recurso no encontrado'])
        ];
    }
}
?>