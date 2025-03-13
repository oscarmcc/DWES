<?php
namespace App\Controllers;
use App\Model\Proyectos;

class ProyectosController extends BaseController{
    public function setProyectosAction(){
        // Comprobamos si el usuario está logueado
        if(empty($_SESSION['id'])){
            header('Location: /');
            exit();
        }

        // Creamos un array para almacenar los datos del formulario
        $data = [];
        $data['titulo'] = $data['descripcion'] = $data['logo'] = $data['tecnologias'] = '';
        $data['error'] = $data['msjErrorTitulo'] = $data['msjErrorDescripcion'] = $data['msjErrorLogo'] = $data['msjErrorTecnologias'] = '';

        $lprocesaFormulario = false;
        if (!empty($_POST)) {
            // Saneamos las entradas antes de utilizarlas
            $data['titulo'] = $_POST['titulo'];
            $data['descripcion'] = $_POST['descripcion'];
            $data['tecnologias'] = $_POST['tecnologias'];
            $data['logo'] = $_FILES['logo'] ?? '';
            $data['usuarios_id'] = $_SESSION['id'];

            $img = false;

            $lprocesaFormulario = true;

            // Validamos que el campo título no esté vacío
            if (empty($data['titulo'])) {
                $lprocesaFormulario = false;
                $data['msjErrorTitulo'] = "* El título no puede estar vacío";
            }

            // Validamos que el campo descripción no esté vacío
            if (empty($data['descripcion'])) {
                $lprocesaFormulario = false;
                $data['msjErrorDescripcion'] = "* La descripción no puede estar vacía";
            }

            // Validamos que el campo tecnologías no esté vacío
            if (empty($data['tecnologias'])) {
                $lprocesaFormulario = false;
                $data['msjErrorTecnologias'] = "* Las tecnologías no pueden estar vacías";
            }

            // Comprobamos si se ha subido una imagen
            if ($data['logo'] && $data['logo']['error'] == 0) {
                // Comprobamos si el archivo subido es una imagen
                if ($data['logo']['type'] == 'image/jpeg' || $data['logo']['type'] == 'image/png') {
                    // Comprobamos si el archivo subido no supera los 2MB
                    if ($data['logo']['size'] <= 2000000) {
                        $img = true;
                    } else {
                        $lprocesaFormulario = false;
                        $data['msjErrorLogo'] = "* La imagen no puede superar los 2MB";
                    }
                } else {
                    $lprocesaFormulario = false;
                    $data['msjErrorLogo'] = "* El archivo subido no es una imagen";
                }
            }
        }

        if ($lprocesaFormulario) {
            if ($img) {
                // Subo la imagen
                $nombre = $data['logo']['name'];
                // Obtengo la extensión de la imagen
                $ext = explode(".", $nombre);
                $name = end($ext);
                // Generamos un nombre para la imagen al azar
                $data['logo']['name'] = uniqid() . "." . $name;
                // Movemos el archivo a la carpeta de imágenes
                move_uploaded_file($data['logo']['tmp_name'], dirname(__DIR__, 2) . '/public/upload/' . $data['logo']['name']);
                $logo = $data['logo']['name'];
            } else {
                $logo = null;
            }

            $proyecto = Proyectos::getInstancia();
            $proyecto->setTitulo($data['titulo']);
            $proyecto->setDescripcion($data['descripcion']);
            $proyecto->setLogo($logo);
            $proyecto->setVisible(1);
            $proyecto->setTecnologias($data['tecnologias']);
            $proyecto->setUsuariosId($data['usuarios_id']);
            $proyecto->set();
            header('Location: /perfil/');
        } else {
            $this->renderHTML('../app/views/setproyectos_view.php', $data);
        }
    }

    public function visibleProyectoAction()
{
    $idProyecto = explode('/', $_SERVER['REQUEST_URI'])[2];

    // Comprobamos si el usuario está logueado
    $proyectoData = Proyectos::getInstancia()->get($idProyecto);
    if ($proyectoData[0]['usuarios_id'] != $_SESSION['id']) {
        header('Location: /');
        exit();
    }

    // Obtenemos la instancia del proyecto
    $proyecto = Proyectos::getInstancia();

    // Comprobamos si el proyecto está visible o no y lo cambiamos
    if ($proyectoData[0]['visible'] == 1) {
        $proyecto->visibilizar(0, $idProyecto);
    } else {
        $proyecto->visibilizar(1, $idProyecto);
    }

    header('Location: /perfil/');
}

    public function modificarProyectoAction(){
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos que el usuario que intenta modificar el proyecto es el propietario del mismo
        $proyecto = Proyectos::getInstancia()->get($id);
        if($proyecto[0]['usuarios_id'] != $_SESSION['id']){
            header('Location: /');
            exit();
        }

        // Creamos un array para almacenar los datos del proyecto
        $data['titulo'] = $data['descripcion'] = $data['tecnologias'] = "";
        $data['proyecto'] = "";
        $data['proyecto'] = $proyecto[0];

        // Si se ha pulsado el botón de modificar
        if(isset($_POST['modificar'])){
            if($_POST['titulo'] ==""){
                $data['titulo'] = $proyecto[0]['titulo'];
            }else{
                $data['titulo'] = $_POST['titulo'];
            }
            if($_POST['descripcion'] ==""){
                $data['descripcion'] = $proyecto[0]['descripcion'];
            }else{
                $data['descripcion'] = $_POST['descripcion'];
            }
            if($_POST['tecnologias'] ==""){
                $data['tecnologias'] = $proyecto[0]['tecnologias'];
            }else{
                $data['tecnologias'] = $_POST['tecnologias'];
            }

            // Modificamos el proyecto
            $proyecto = Proyectos::getInstancia();
            $proyecto->setTitulo($data['titulo']);
            $proyecto->setDescripcion($data['descripcion']);
            $proyecto->setTecnologias($data['tecnologias']);
            $proyecto->edit($id);
            header('Location: /perfil/');
        }
        $this->renderHTML('../app/views/modificar_proyecto_view.php', $data);
    }

    public function eliminarProyectoAction(){
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos que el usuario que intenta eliminar el proyecto es el propietario del mismo
        $idProyectocomprobacion = Proyectos::getInstancia()->get($id);
        if($idProyectocomprobacion[0]['usuarios_id'] != $_SESSION['id']){
            header('Location: /');
            exit();
        }
        $proyecto = Proyectos::getInstancia();
        $proyecto->delete($id);
        header('Location: /perfil/');
    }
}
?>