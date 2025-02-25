<?php
namespace App\Controllers;
use App\Models\Centros_Civicos;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class CentrosCivicosController{
    private $requestMethod;
    private $centrosCivicos;
    // private $usuarioId;

    public function __construct($requestMethod){
        $this->requestMethod = $requestMethod;
        // $this->usuarioId = $usuarioId;
        $this->centrosCivicos = Centros_Civicos::getInstancia();
    }

    public function processRequest(){
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
        switch($this->requestMethod){
            case 'GET':
                if(isset($uri[3])){
                    $response = $this->getCentroCivico($uri[3]);
                } else {
                    $response = $this->getAllCentros();
                }
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if($response['body']){
            echo $response['body'];
        }
    }

    private function getAllCentros(){

        $result = $this->centrosCivicos->getAll();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getCentroCivico($id=''){
        $result = $this->centrosCivicos->get(['id' => $id]);
        if(!$result){
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }
    private function notFoundResponse(){
        return [
            'status_code_header' => 'HTTP/1.1 404 Not Found',
            'body' => json_encode(['message' => 'Centro cívivo no encontrado'], JSON_UNESCAPED_UNICODE)
        ];
    }

}
?>