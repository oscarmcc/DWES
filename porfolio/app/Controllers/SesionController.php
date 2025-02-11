<?php
// le asiganmos un espacio de nombres e importamos la clase Users con el espacio de nombres que le hemos asignado
namespace App\Controllers;
use App\Model\Users;
use App\Core\EmailSender;
class SesionController extends BaseController
{
    public function loginAction()
{
    $data = array();
    $data['email'] = $data['passwd'] = '';
    $data['error'] = '';

    if (!empty($_POST)) {
        $data['email'] = $_POST['email'];
        $data['passwd'] = $_POST['passwd'];
        
        $usuario1 = Users::getInstancia();

        // Validar que el campo email no esté vacío
        if (empty($data['email'])) {
            $data['error'] = 'El email no puede estar vacío';
            $this->renderHTML('../app/views/login_view.php', $data);
            return;
        }

        // Validar que el campo contraseña no esté vacío
        if (empty($data['passwd'])) {
            $data['error'] = 'La contraseña no puede estar vacía';
            $this->renderHTML('../app/views/login_view.php', $data);
            return;
        }

        // Obtener el usuario por email
        $resultado = $usuario1->getUsuarioEmail($data['email']);
        if (!$resultado) {
            $data['error'] = 'El email no existe';
            $this->renderHTML('../app/views/login_view.php', $data);
            return;
        }

        // Verificar la contraseña ingresada con el hash almacenado
        if (password_verify($data['passwd'], $resultado[0]['passwd'])) {
            $_SESSION['id'] = $resultado[0]['id'];
            $_SESSION['rol']='user';
            header('Location: /');
            exit();
        } else {
            $data['error'] = 'Contraseña incorrecta';
            $this->renderHTML('../app/views/login_view.php', $data);
            return;
        }
    }

    $this->renderHTML('../app/views/login_view.php', $data);
}
    public function registrerAction() {
        $lprocesaFormulario = false;
        $data = array();
        $data['nombre'] = $data['apellidos'] = $data['email'] = $data['password']= $data['passwordConfirmation'] = $data['resumen_perfil'] = $data['categoria_profesional'] = $data['picture'] = $data['token']='';
        $data['msjErrorNombre'] = $data['msjErrorApellidos'] = $data['msjErrorEmail'] = $data['msjErrorPassword'] = $data['msjErrorCategoriaProfesional'] = $data['msjErrorResumenPerfil'] = $data['msjErrorImagen'] = '';
    
        if (!empty($_POST)) {
            // Saneamos las entradas antes de utilizarlas
            $data['nombre'] = $_POST['nombre'];
            $data['apellidos'] = $_POST['apellidos'];
            $data['email'] = $_POST['email'];
            $data['password'] = $_POST['passwd'];
            $data['passwordConfirmation'] = $_POST['passwdConfirmation'];
            $data['resumen_perfil'] = $_POST['resumen_perfil'];
            $data['categoria_profesional'] = $_POST['categoria_profesional'];
            $data['picture'] = $_FILES['foto'];
            
            $img = false;
            // Creamos una instancia de usuarios
            $usuario1 = Users::getInstancia();
    
            $lprocesaFormulario = true;
    
            // Validamos que el campo nombre no esté vacío
            if (empty($data['nombre'])) {
                $lprocesaFormulario = false;
                $data['msjErrorNombre'] = "* El nombre no puede estar vacío";
            }
    
            // Validamos que el campo apellidos no esté vacío
            if (empty($data['apellidos'])) {
                $lprocesaFormulario = false;
                $data['msjErrorApellidos'] = "* Los apellidos no pueden estar vacíos";
            }
    
            // Validamos que el campo email no esté vacío
            if (empty($data['email'])) {
                $lprocesaFormulario = false;
                $data['msjErrorEmail'] = "* El email no puede estar vacío";
            }
    
            // Validamos que el email no se encuentre ya en la base de datos
            if ($usuario1->getUsuarioEmail($data['email'])) {
                $lprocesaFormulario = false;
                $data['msjErrorEmail'] = "* El email ya está en uso";
            }
    
            // Validamos que el campo password no esté vacío
            if (empty($data['password'])) {
                $lprocesaFormulario = false;
                $data['msjErrorPassword'] = "* La contraseña no puede estar vacía";
            }

            // Validamos que el campo passwordConfirmation no esté vacío
            if (empty($data['passwordConfirmation'])) {
                $lprocesaFormulario = false;
                $data['msjErrorPassword'] = "* Debes volver a repetir no puede estar vacía";
            }

            // Validamos que las contraseñas coincidan
            if ($data['password'] != $data['passwordConfirmation']) {
                $lprocesaFormulario = false;
                $data['msjErrorPassword'] = "* Las contraseñas no coinciden";
            }
    
            // Comprobamos si se ha subido una imagen
            if ($data['picture'] && $data['picture']['error'] == 0) {
                // Comprobamos si el archivo subido es una imagen
                if ($data['picture']['type'] == 'image/jpeg' || $data['picture']['type'] == 'image/png') {
                    // Comprobamos si el archivo subido no supera los 2MB
                    if ($data['picture']['size'] <= 2000000) {
                        $img = true;
                    } else {
                        $lprocesaFormulario = false;
                        $data['msjErrorImagen'] = "* La imagen no puede superar los 2MB";
                    }
                } else {
                    $lprocesaFormulario = false;
                    $data['msjErrorImagen'] = "* El archivo subido no es una imagen";
                }
            }
        }
        // var_dump($data);
    
        if ($lprocesaFormulario) {
            if ($img) {
                // Subo la imagen
                $nombre = $data['picture']['name'];
                // Obtengo la extension de la imagen
                $ext = explode(".", $nombre);
                $name = end($ext);
                // Generamos un nombre para la imagen al azar
                $data['picture']['name'] = uniqid() . "." . $name;
                // Movemos el archivo a la carpeta de imágenes
                move_uploaded_file($data['picture']['tmp_name'], dirname(__DIR__, 2) . '/public/upload/' . $data['picture']['name']);
                $foto = $data['picture']['name'];
            } else {
                $foto = null;
            }

            $rb = random_bytes(32);
            $token  = base64_encode($rb);
            $secureToken = uniqid('',true) . $token;
            $data['token'] = $secureToken;


            $usuario1->setToken($data['token']);
            $usuario1->setNombre($data['nombre']);
            $usuario1->setApellidos($data['apellidos']);
            $usuario1->setEmail($data['email']);
            $usuario1->setPasswd(password_hash($data['password'], PASSWORD_DEFAULT));
            $usuario1->setResumenPerfil($data['resumen_perfil']);
            $usuario1->setCategoriaProfesional($data['categoria_profesional']);
            $usuario1->setFoto($foto);
            $usuario1->set();
            header('Location: /login/');
        } else {
            $this->renderHTML('../app/views/registrer_view.php', $data);
        }
    }
    
        public function logoutAction(){
            // cerramos la sesion y redirigimos a la página principal
            $data = [];
            session_start();
            session_unset();
            session_destroy();
            header('Location: /');
        }
        
        // public function verificarAction(){
        //     $token=explode('/', string: $_SERVER['REQUEST_URI'][2]);

        //     $token = array_slice($token, 2);
        //     $token = implode('/', $token);

        //     $usuario = Users::getInstancia();
        //     $usuario->verificarToken($token);

        //     if ($usuario->getMensaje() == 'Usuario verificado'){
        //         header('Location: /login/');
        //     }else{
        //         echo "<h2>" . $usuario->getMensaje() . "</h2>";
        //     header('Location: /login');
        //     }
        // }
    }

?>