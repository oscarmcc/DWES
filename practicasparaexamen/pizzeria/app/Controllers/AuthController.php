<?php
namespace App\Controllers;

use App\Models\Clientes;
use App\Models\Pizzas;
class AuthController extends BaseController
{
    public function registroAction(){

        $lprocesaFormulario = false;

        $data['nombre'] = $data['apellidos'] = $data['email'] = $data['password'] = $data['foto'] = $data['passwordConfirm'] = '';
        $data['eNombre'] = $data['eApellidos'] = $data['eEmail'] = $data['ePassword'] = $data['eFoto'] = $data['ePasswordConfirm'] = '';
        $data['eCaptcha'] = $data['eCaptchaLetras'] = '';

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lprocesaFormulario = true;
            $data['nombre'] = $_POST['nombre'];
            $data['apellidos'] = $_POST['apellidos'];
            $data['email'] = $_POST['email'];
            $data['password'] = $_POST['password'];
            $data['foto'] = $_FILES['foto'];
            $data['passwordConfirm'] = $_POST['passwordConfirm'];
            $captcha = $_POST['captcha'];
            $num1 = $_POST['num1'];
            $num2 = $_POST['num2'];

            $captcha_letras = $_POST['captcha_letras'];
            $captcha_letras_original = $_POST['captcha_letras_original'];

            $img = false;

            $clientes = Clientes::getInstancia();
            $lprocesaFormulario = true;


            if (empty($data['nombre'])) {
                $data['eNombre'] = 'El nombre es obligatorio';
                $lprocesaFormulario = false;
            }

            if (empty($data['apellidos'])) {
                $data['eApellidos'] = 'Los apellidos son obligatorios';
                $lprocesaFormulario = false;
            }

            if (empty($data['email'])) {
                $data['eEmail'] = 'El email es obligatorio';
                $lprocesaFormulario = false;
            }

            if (empty($data['password'])) {
                $data['ePassword'] = 'La contraseña es obligatoria';
                $lprocesaFormulario = false;
            }

            if ($data['password'] != $data['passwordConfirm']) {
                $data['ePasswordConfirm'] = 'Las contraseñas no coinciden';
                $lprocesaFormulario = false;
            }

                // Validar captcha
            if ($captcha != $num1 + $num2) {
                $data['eCaptcha'] = 'La respuesta del captcha es incorrecta';
                $lprocesaFormulario = false;
            }

            if ($captcha_letras != $captcha_letras_original) {
                $data['eCaptchaLetras'] = 'El captcha de letras no es correcto';
                $lprocesaFormulario = false;
            }

            // Comprobamos si se ha subido una imagen
            if ($data['foto'] && $data['foto']['error'] == 0) {
                // Comprobamos si el archivo subido es una imagen
                if ($data['foto']['type'] == 'image/jpeg' || $data['foto']['type'] == 'image/png') {
                    // Comprobamos si el archivo subido no supera los 2MB
                    if ($data['foto']['size'] <= 2000000) {
                        $img = true;
                    } else {
                        $lprocesaFormulario = false;
                        $data['eFoto'] = "* La imagen no puede superar los 2MB";
                    }
                } else {
                    $lprocesaFormulario = false;
                    $data['eFoto'] = "* El archivo subido no es una imagen";
                }
            }

        }
        if ($lprocesaFormulario) {
            if ($img) {
                // Subo la imagen
                $nombre = $data['foto']['name'];
                // Obtengo la extension de la imagen
                $ext = explode(".", $nombre);
                $name = end($ext);
                // Generamos un nombre para la imagen al azar
                $data['foto']['name'] = uniqid() . "." . $name;
                // Movemos el archivo a la carpeta de imágenes
                move_uploaded_file($data['foto']['tmp_name'], dirname(__DIR__, 2) . '/public/uploads/' . $data['foto']['name']);
                $foto = $data['foto']['name'];
            } else {
                $foto = "default.png";
            }

            var_dump($data);

            $clientes->setNombre($data['nombre']);
            $clientes->setApellidos($data['apellidos']);
            $clientes->setEmail($data['email']);
            $clientes->setPassword($data['password']);
            $clientes->setFoto($foto);
            $clientes->set();


            header('Location: /');
        } else {
            $this->renderHTML('../app/views/registro_view.php', $data);
        }

    }

    public function loginAction() {
        $data = array();
        $data['email'] = $data['password'] = '';
        $data['error'] = '';

        // Verificar si se ha enviado el formulario
        if (!empty($_POST)) {
            // Asignar los datos del formulario a las variables
            $data['email'] = $_POST['email'];
            $data['password'] = $_POST['password'];

            $oCliente = Clientes::getInstancia();
            $cliente = $oCliente->getByEmail($data['email']);

            // Verificar si el cliente existe y la contraseña es correcta
            if ($cliente) {
                if ($data['password'] == $cliente['password']) {
                    // Iniciar sesión
                    $_SESSION['id'] = $cliente['id'];
                    $_SESSION['rol'] = "cliente";

                    var_dump($_SESSION);

                    // Redirigir a la página principal
                    header("Location: /");
                    exit();
                } else {
                    $data['error'] = 'Contraseña incorrecta';
                }
            } else {
                $data['error'] = 'cliente incorrecto';
            }
        }

        // Renderizar la vista de inicio de sesión con los datos
        $this->renderHTML('../app/views/index_view.php', $data);
    }

    public function logoutAction() {
        // Cerrar la sesión
        session_destroy();
        // Redirigir a la página principal
        header("Location: /");
    }

    public function eliminarUsuarioAction(){
        if(empty($_SESSION['id'])){
            header('Location: /login/');
            return;
        }

        $clientes = Clientes::getInstancia();
        $clientes->delete($_SESSION['id']);
        session_destroy();
        header('Location: /');
    }

}

?>