<?php
namespace App\Controllers;

use App\Model\Trabajos;

class TrabajoController extends BaseController{
    public function setTrabajoAction(){
        // Comprobamos si el usuario está logueado
        if(empty($_SESSION['id'])){
            header('Location: /');
        }

        // Creamos un array para almacenar los datos del formulario
        $data = array();
        $data['titulo'] = $data['descripcion'] = $data['fecha_inicio'] = $data['fecha_final'] = '';
        $data['logros'] = '';
        $data['error'] = '';

        // Comprobamos si se ha enviado el formulario
        if (!empty($_POST)) {
            $data['titulo'] = $_POST['titulo'];
            $data['descripcion'] = $_POST['descripcion'];
            $data['fecha_inicio'] = $_POST['fecha_inicio'];
            $data['fecha_final'] = $_POST['fecha_final'];
            $data['logros'] = $_POST['logros'];
            $data['usuarios_id'] = $_SESSION['id'];

            if (empty($data['titulo'])) {
                $data['error'] = 'El título no puede estar vacío';
                $this->renderHTML('../app/views/settrabajo_view.php', $data);
                return;
            }
            if (empty($data['descripcion'])) {
                $data['error'] = 'La descripción no puede estar vacía';
                $this->renderHTML('../app/views/settrabajo_view.php', $data);
                return;
            }

            // Si no hay errores, insertamos los datos en la base de datos
            $trabajo = Trabajos::getInstancia();
            $trabajo->setTitulo($data['titulo']);
            $trabajo->setDescripcion($data['descripcion']);
            $trabajo->setFechaInicio($data['fecha_inicio']);
            $trabajo->setFechaFinal($data['fecha_final']);
            $trabajo->setLogros($data['logros']);
            $trabajo->setUsuariosId($data['usuarios_id']);
            $trabajo->setVisible(1);
            $trabajo->set();
            header('Location: /perfil/');
            exit();
        } else {
            $this->renderHTML('../app/views/settrabajo_view.php', $data);
        }
    }

    public function visibleTrabajoAction(){
        $idTrabajo = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos si el usuario está logueado
        $idTrabajoComprobacion = Trabajos::getInstancia()->get($idTrabajo);
        if($idTrabajoComprobacion[0]['usuarios_id'] != $_SESSION['id']){
            header('Location: /');
        }

        // Creamos un array para almacenar los datos del formulario
        $trabajo = Trabajos::getInstancia();
        $usuariotrabajo = $trabajo->get($idTrabajo);
        // var_dump($usuariotrabajo);

        // Comprobamos si el trabajo está visible o no y lo cambiamos
        if($usuariotrabajo['visible'] == 1){
            $trabajo->visibilizar(0,$idTrabajo);
            header('Location: /perfil/');
        }else{
            $trabajo->visibilizar(1,$idTrabajo);
            header('Location: /perfil/');
        }
    }

    public function eliminarTrabajoAction(){
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos que el usuario que intenta eliminar el trabajo es el propietario del mismo
        $idTrabajocomprobacion = Trabajos::getInstancia()->get($id);
        if($idTrabajocomprobacion[0]['usuarios_id'] != $_SESSION['id']){
            header('Location: /');
        }
        $trabajo = Trabajos::getInstancia();
        $trabajo->delete($id);
        header('Location: /perfil/');
    }

    public function modificarTrabajoAction(){
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos que el usuario que intenta modificar el trabajo es el propietario del mismo
        $trabajos = Trabajos::getInstancia()->get($id);
        if($trabajos['usuarios_id'] != $_SESSION['id']){
            header('Location: /');
        }

        // Creamos un array para almacenar los datos del trabajo
        $data['titulo'] = $data['descripcion'] = $data['fecha_inicio'] = $data['fecha_fin'] = $data['logros'] = "";
        $data['trabajo'] = "";
        $data['trabajo'] = $trabajos;

        // Si se ha pulsado el botón de modificar
        if(isset($_POST['modificar'])){
            if($_POST['titulo'] ==""){
                $data['titulo'] = $trabajos[0]['titulo'];
            }else{
                $data['titulo'] = $_POST['titulo'];
            }
            if($_POST['descripcion'] ==""){
                $data['descripcion'] = $trabajos[0]['descripcion'];
            }else{
                $data['descripcion'] = $_POST['descripcion'];
            }
            if($_POST['fecha_inicio'] ==""){
                $data['fecha_inicio'] = $trabajos[0]['fecha_inicio'];
            }else{
                $data['fecha_inicio'] = $_POST['fecha_inicio'];
            }
            if($_POST['fecha_fin'] ==""){
                $data['fecha_fin'] = $trabajos[0]['fecha_fin'];
            }else{
                $data['fecha_fin'] = $_POST['fecha_fin'];
            }
            if($_POST['logros'] ==""){
                $data['logros'] = $trabajos[0]['logros'];
            }else{
                $data['logros'] = $_POST['logros'];
            }

            // Modificamos el trabajo
            $trabajo = Trabajos::getInstancia();
            $trabajo->setTitulo($data['titulo']);
            $trabajo->setDescripcion($data['descripcion']);
            $trabajo->setFechaInicio($data['fecha_inicio']);
            $trabajo->setFechaFinal($data['fecha_fin']);
            $trabajo->setLogros($data['logros']);
            $trabajo->edit($id);
            header('Location: /perfil/');
        }
        $this->renderHTML('../app/views/modificar_trabajo_view.php', $data);
    }
}


?>