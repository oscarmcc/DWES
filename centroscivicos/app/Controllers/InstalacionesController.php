<?php
namespace App\Controllers;
use App\Models\Instalaciones;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class InstalacionesController
{
    private $requestMethod;
    private $instalaciones;

    public function __construct($requestMethod)
    {
        $this->requestMethod = $requestMethod;
        $this->instalaciones = Instalaciones::getInstancia();
    }

    public function processRequest()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);
        switch ($this->requestMethod) {
            case 'GET':
                if (isset($uri[3])) {
                    $response = $this->getInstalaciones($uri[3]);
                } else {
                    $response = $this->getInstalacionesFilter();
                }
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

    private function getInstalacionesFilter()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $result = $this->instalaciones->getByFilter($input);

        if (!$result) {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response; 
    }

    private function getInstalaciones($id = '')
    {
        $result = $this->instalaciones->get(['id_centro_civico' => $id]);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function notFoundResponse()
    {
        return [
            'status_code_header' => 'HTTP/1.1 404 Not Found',
            'body' => json_encode(['message' => 'Instalación no encontrada'], JSON_UNESCAPED_UNICODE)
        ];
    }
}