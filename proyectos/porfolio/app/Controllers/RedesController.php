<?php
namespace App\Controllers;
use App\Model\Redes;

class RedesController extends BaseController{
    public function setRedesAction(){
        // Comprobamos si el usuario está logueado
        if(empty($_SESSION['id'])){
            header('Location: /');
            exit();
        }

        // Creamos un array para almacenar los datos del formulario
        $data = [];
        $data['redesnombres'] = $data['redeslinks'] = '';
        $data['error'] = '';

        // Comprobamos si se ha enviado el formulario
        if(!empty($_POST)){
            $data['redesnombres'] = $_POST['redesnombres'];
            $data['redeslinks'] = $_POST['redeslinks'];
            $data['usuarios_id'] = $_SESSION['id'];

            if(empty($data['redesnombres'])){
                $data['error'] = 'El nombre de la red social no puede estar vacío';
                $this->renderHTML('../app/views/setredes_view.php', $data);
                return;
            }
            if(empty($data['redeslinks'])){
                $data['error'] = 'El link de la red social no puede estar vacío';
                $this->renderHTML('../app/views/setredes_view.php', $data);
                return;
            }

            // var_dump($data);

            // Si no hay errores, insertamos los datos en la base de datos
            $redes = Redes::getInstancia();
            $redes->setRedesSocialcol($data['redesnombres']);
                $redes->setUrl($data['redeslinks']);
               $redes ->setUsuariosId($data['usuarios_id']);
                $redes->set();
            header('Location: /perfil/');
            exit();
        }else{
            $this->renderHTML('../app/views/setredes_view.php', $data);
        }
    }

    public function modificarRedAction(){
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos que el usuario que intenta modificar la red social es el propietario de la misma
        $redes = Redes::getInstancia()->get($id);
        if($redes[0]['usuarios_id'] != $_SESSION['id']){
            header('Location: /');
            exit();
        }

        // Creamos un array para almacenar los datos de la red social
        $data['nombre'] = $data['url'] = "";
        $data['red'] = "";
        $data['red'] = $redes[0];
        // var_dump($data['red']);

        // Si se ha pulsado el botón de modificar
        if(isset($_POST['modificar'])){
            if($_POST['nombre'] ==""){
                $data['nombre'] = $redes[0]['redes_socialcol'];
            }else{
                $data['nombre'] = $_POST['nombre'];
            }
            if($_POST['url'] ==""){
                $data['url'] = $redes[0]['url'];
            }else{
                $data['url'] = $_POST['url'];
            }

            // Modificames la red social
            $red = Redes::getInstancia();
            $red->setRedesSocialcol($data['nombre']);
            $red->setUrl($data['url']);
            $red->edit($id);
            header('Location: /perfil/');
        }
        $this->renderHTML('../app/views/modificar_red_view.php', $data);

    }

    public function eliminarRedAction(){
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos que el usuario que intenta eliminar la red social es el propietario de la misma
        $idRedcomprobacion = Redes::getInstancia()->get($id);
        if($idRedcomprobacion[0]['usuarios_id'] != $_SESSION['id']){
            header('Location: /');
            exit();
        }
        $red = Redes::getInstancia();
        $red->delete($id);
        header('Location: /perfil/');
    }
}

?>