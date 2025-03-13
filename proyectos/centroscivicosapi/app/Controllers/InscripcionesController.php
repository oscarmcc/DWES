<?php
namespace App\Controllers;

use Exception;
use App\Models\Inscripciones;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class InscripcionesController{

    private $requestMethod;
    private $inscripciones;
    private $usuariosId;

    public function __construct($requestMethod, $usuariosId)
    {
        $this->requestMethod = $requestMethod;
        $this->usuariosId = $usuariosId;
        $this->inscripciones = Inscripciones::getInstancia();
    }

    public function processRequest(){

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);

        switch($this->requestMethod){
            case 'GET':
                $response = $this->getInscripciones();
                break;

            case 'POST':
                $response = $this->NuevaInscripcion();
                break;

            case 'DELETE':
                $response = $this->deleteInscripcion($uri[3]);
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


    private function NuevaInscripcion()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;

        $jwt = explode(" ", $authHeader)[1] ?? null;

        try {
            $decoded = JWT::decode($jwt, new Key(KEY, 'HS256'));
            $idUser = $decoded->data->{0} ?? null;

        } catch (Exception $e) {
            return $this->unprocessableEntityResponse("HTTP/1.1 401 Unauthorized", "Acceso denegado: ");
        }

        if (!isset($input['nombre']) || !isset($input['telefono']) || !isset($input['email']) || !isset($input['id_actividad']) || !isset($input['fecha']) || !isset($input['estado'])) {
            return $this->unprocessableEntityResponse("HTTP/1.1 400 Bad Request", "El nombre, telefono, email, id_actividad, fecha y estado son obligatorios.");
        }

        if (count($input) > 6) {
            return $this->unprocessableEntityResponse("HTTP/1.1 400 Bad Request", "Solo puede escribir el nombre, telefono, email, id_actividad, fecha y estado.");
        }

        $plazas = $this->inscripciones->getPlazas($input['id_actividad']);
        $numInscripciones = $this->inscripciones->getInscripcionesPorActividad(['id_actividad' => $input['id_actividad']]);

        // var_dump($plazas);
        // var_dump($numInscripciones);
        if($numInscripciones >= $plazas){
            return $this->unprocessableEntityResponse("HTTP/1.1 400 Bad Request", "No hay plazas disponibles.");
        }

        $input['user_id'] = $idUser;
        $this->inscripciones->set($input);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode(['message' => 'Inscripción agregada']);
        return $response;

    }

    private function getInscripciones()
    {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;

        $jwt = explode(" ", $authHeader)[1] ?? null;

        try {
            $decoded = JWT::decode($jwt, new Key(KEY, 'HS256'));
            $idUser = $decoded->data->{0} ?? null;

        } catch (Exception $e) {
            return $this->unprocessableEntityResponse("HTTP/1.1 401 Unauthorized", "Acceso denegado: ");
        }

        $data = $this->inscripciones->get(['user_id' => $idUser]);

        if (!$data) {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($data);
        return $response;
    }

    private function deleteInscripcion($id = "")
    {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;

        $jwt = explode(" ", $authHeader)[1] ?? null;

        try {
            $decoded = JWT::decode($jwt, new Key(KEY, 'HS256'));
            $idUser = $decoded->data->{0} ?? null;

        } catch (Exception $e) {
            return $this->unprocessableEntityResponse("HTTP/1.1 401 Unauthorized", "Acceso denegado: ");
        }

        $data = $this->inscripciones->get(['id' => $id]);

        if (!$data) {
            return $this->notFoundResponse();
        }

        $this->inscripciones->delete($id);

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(['message' => 'Inscripción eliminada']);
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