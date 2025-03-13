<?php

    namespace App\Controllers;
    use App\Models\Usuarios;

class IndexCOntroller extends BaseController
{
    // Funcion que se encarga de la vista principal la cual tambien tiene la parte del login de los usuarios
    public function IndexAction()
    {
        $data = [];
        $videos = ['https://www.youtube.com/watch?v=XyHdFT1OQr4','https://www.youtube.com/watch?v=vgyJJHVY3Qc','https://www.youtube.com/watch?v=9Q7cZRRdPss'];
        $video = $videos[rand(0, 2)];

        $data['usuario'] = $data['password'] = '';
        $data['eUsuario'] = $data['ePassword'] = '';
        $data['imagenSeleccionada'] = '';
        
        $data['imagen'] = "";

        // var_dump($_SESSION);die();

        // Si el metodo de la peticion es POST se obtienen los datos del formulario y se comprueba si estos se encuentran vacios
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data['usuario'] = $_POST['usuario'];
            $data['password'] = $_POST['password'];

            $data['imagenSeleccionada']=$_POST['imagen']??null;
            $data['imagen'] = $_POST['imagenrequerida']??null;

            
            if (empty($data['usuario'])) {
                $data['eUsuario'] = 'El usuario es obligatorio';
                header('Location: /');
                exit();
            }

            if (empty($data['password'])) {
                $data['ePassword'] = 'La contraseña es obligatoria';
                header('Location: /');
                exit();
            }

            if (empty($data['imagenSeleccionada']) ) {
                $data['eImagen'] = 'La imagen es obligatoria';
                header('Location: /');
                exit();
            }
            // var_dump($data);die();
            // var_dump($data['imagenSeleccionada'][0]);
            // var_dump($imagen);die();
            if ($data['imagenSeleccionada'][0] != $data['imagen']) {
                $data['eImagen'] = 'La imagen seleccionada no es correcta';
                // var_dump($data['imagenSeleccionada'][0]);
                // var_dump($data['imagen']);
                // var_dump($data['eImagen']);die();
                header('Location: /');
                exit();
            }

            // Se obtiene el usuario a traves del nombre de usuario
            $usuarios = Usuarios::getInstancia();
            $usuario = $usuarios->getByUsuario($data['usuario']);


            // Si el usuario existe se comprueba si la contraseña es correcta
            if ($usuario) {
                if($data['password'] == $usuario['password']){
                    $_SESSION['rol'] = $usuario['perfil'];
                    $_SESSION['id'] = $usuario['id'];
                    header('Location: /');
                    exit();
                } else {
                    $data['eUsuario'] = 'Usuario o contraseña incorrectos';
                }
            } else {
                $data['eUsuario'] = 'Usuario o contraseña incorrectos';
            }
        }
        $this->renderHTML('../app/views/index_view.php', $data);

    }
}
?>