<?php

namespace App\Controllers;

use App\Models\Contactos;
use Firebase\JWT\JWT;
use FireBase\JWT\Key;
use App\Model\Usuarios; // Ensure this class exists in the specified namespace

class AuthController
{
    private $requestMethod;
    private $userId;
    private $users;

    public function __construct($requestMethod)
    {
        $this->requestMethod = $requestMethod;
        $this->users = Usuarios::getInstancia();
    }

    public function loginFromRequest()
    {

        // Leemos el flujo de entrada

        $input = json_decode(file_get_contents('php://input'), TRUE);
        // Determinamos si el formato de entrada es correcto
        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode([
                'message' => 'El cuerpo de la solicitud no es un JSON válido',
                'error' => json_last_error_msg()
            ]);
        }

        // Defininmos dos variables para almacenar el usuario y la contraseña
        $usuario = $input['usuario'];
        $password = $input['password'];


        $dataUser = $this->users->getLogin($usuario, $password);

        if ($dataUser) {
            $key = KEY; // Clave para firmar el JWT
            $issuer_claim = "http://unidad8apirestcontactos.local";
            $audience_claim = "http://unidad8apirestcontactos.local";
            $issuedat_claim = time(); // Hora a la que se emitió el JWT
            $notbefore_claim = time(); // No antes de esta hora
            $expire_claim = $issuedat_claim + 3600; // Expira en una hora desde la hora de emisión

            $token = array(
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $issuedat_claim,
                "nbf" => $notbefore_claim,
                "exp" => $expire_claim,
                "data" => array(
                    "usuario" => $usuario,
                )
            );

            $jwt = JWT::encode($token, $key, 'HS256');
            $res = json_encode(
                array(
                    'message' => "Inicio de sesión exitoso.",
                    'jwt' => $jwt,
                    'email' => $usuario,
                    'expireAt' => $expire_claim
                )
            );

            $response['status_code_header'] = 'HTTP/1.1 201 Created'; // Código de respuesta
            $response['body'] = $res; // Cuerpo de la respuesta
        } else {
            $response['status_code_header'] = 'HTTP/1.1 401 Login failed'; // Código de respuesta
            $response['body'] = json_encode(array('message' => 'Inicio de sesión fallido.')); // Cuerpo de la respuesta
        }

        header($response['status_code_header']); // Envía el encabezado de la respuesta
        if ($response['body']) {
            echo $response['body']; // Imprime el cuerpo de la respuesta si existe
}
    }
}