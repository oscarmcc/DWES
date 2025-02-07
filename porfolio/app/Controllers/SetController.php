<?php

namespace App\Controllers;
use App\Model\Users;
use App\Model\Proyectos;
use App\Model\Trabajos;
use App\Model\Redes;
use App\Model\Skills;
use App\Model\CategoriasSkills;

class SetController extends BaseController{

    // Función para añadir un nuevo usuario
    public function setTrabajoAction(){
        // Comprobamos si el usuario está logueado
        if(strlen($_SESSION['id']) == 0){
            header('Location: /');
            exit();
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

    // Función para añadir un nuevo usuario
    public function setRedesAction(){
        // Comprobamos si el usuario está logueado
        if(strlen($_SESSION['id']) == 0){
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

    // Función para añadir un nuevo usuario
    public function setProyectosAction(){
        // Comprobamos si el usuario está logueado
        if(strlen($_SESSION['id']) == 0){
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

    // Función para añadir un nuevo usuario
    public function setSkillsAction(){
        // Comprobamos si el usuario está logueado
        if(strlen($_SESSION['id']) == 0){
            header('Location: /');
            exit();
        }

        // Creamos un array para almacenar los datos del formulario
        $data = [];
        $data['habilidades'] = $data['categorias_skill_categoria'] = $data['categorias_skills'] = '';
        $data['error'] = '';

        $categorias_skils = CategoriasSkills::getInstancia();
        $data['categorias_skills'] = $categorias_skils->get();
        
        // Comprobamos si se ha enviado el formulario
        if(!empty($_POST)){
            $data['habilidades'] = $_POST['habilidades'];
            $data['categorias_skill_categoria'] = $_POST['categorias_skill_categoria']?? '';
            $data['usuarios_id'] = $_SESSION['id'];

            if(empty($data['habilidades'])){
                $data['error'] = 'Las habilidades no pueden estar vacías';
                $this->renderHTML('../app/views/setskills_view.php', $data);
                return;
            }
            if(empty($data['categorias_skill_categoria'])){
                $data['error'] = 'La categoría no puede estar vacía';
                $this->renderHTML('../app/views/setskills_view.php', $data);
                return;
            }
            // var_dump($data);

            // Si no hay errores, insertamos los datos en la base de datos
            $skills = Skills::getInstancia();
            $skills->setHabilidades($data['habilidades']);
            $skills->setUsuariosId($data['usuarios_id']);
            $skills->setVisible(1);
            $skills->setCategoriasSkillCategoria($data['categorias_skill_categoria']);
            $skills->set();
            header('Location: /perfil/');
            exit();
        }else{
            $this->renderHTML('../app/views/setskills_view.php', $data);
        }
    }

}