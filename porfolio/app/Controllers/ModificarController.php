<?php

namespace App\Controllers;
use App\Model\Users;
use App\Model\Proyectos;
use App\Model\Trabajos;
use App\Model\Redes;
use App\Model\Skills;
use App\Model\CategoriasSkills;
class ModificarController extends BaseController
{
    // Modificar una red social
    public function modificarRedAction(){
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos que el usuario que intenta modificar la red social es el propietario de la misma
        $redcomprobacion = Redes::getInstancia() ->get($id);
        if($redcomprobacion[0]['usuarios_id'] != $_SESSION['id'] || $redcomprobacion[0]['usuarios_id'] == null){
            header('Location: /');
            exit();
        }

        // Creamos un array para almacenar los datos de la red social
        $data['nombre'] = $data['url'] = "";
        $data['red'] = "";
        $redes = Redes::getInstancia()->get($id);
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

    // Modificar un proyecto
    public function modificarProyectoAction(){
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos que el usuario que intenta modificar el proyecto es el propietario del mismo
        $proyectocomprobacion = Proyectos::getInstancia() ->get($id);
        if($proyectocomprobacion[0]['usuarios_id'] != $_SESSION['id'] || $proyectocomprobacion[0]['usuarios_id'] == null){
            header('Location: /');
            exit();
        }

        // Creamos un array para almacenar los datos del proyecto
        $data['titulo'] = $data['descripcion'] = $data['tecnologias'] = "";
        $data['proyecto'] = "";
        $proyectos = Proyectos::getInstancia()->get($id);
        $data['proyecto'] = $proyectos[0];

        // Si se ha pulsado el botón de modificar
        if(isset($_POST['modificar'])){
            if($_POST['titulo'] ==""){
                $data['titulo'] = $proyectos[0]['titulo'];
            }else{
                $data['titulo'] = $_POST['titulo'];
            }
            if($_POST['descripcion'] ==""){
                $data['descripcion'] = $proyectos[0]['descripcion'];
            }else{
                $data['descripcion'] = $_POST['descripcion'];
            }
            if($_POST['tecnologias'] ==""){
                $data['tecnologias'] = $proyectos[0]['tecnologias'];
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

    // Modificar un trabajo
    public function modificarTrabajoAction(){
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos que el usuario que intenta modificar el trabajo es el propietario del mismo
        $trabajocomprobacion = Trabajos::getInstancia() ->get($id);
        if($trabajocomprobacion['usuarios_id'] != $_SESSION['id'] || $trabajocomprobacion['usuarios_id'] == null){
            header('Location: /');
            exit();
        }

        // Creamos un array para almacenar los datos del trabajo
        $data['titulo'] = $data['descripcion'] = $data['fecha_inicio'] = $data['fecha_fin'] = $data['logros'] = "";
        $data['trabajo'] = "";
        $trabajos = Trabajos::getInstancia()->get($id);
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


    // Modificar una skill
    public function modificarSkillAction(){
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos que el usuario que intenta modificar la skill es el propietario de la misma
        $skillcomprobacion = Skills::getInstancia() ->getById($id);
        if($skillcomprobacion[0]['usuarios_id'] != $_SESSION['id'] || $skillcomprobacion[0]['usuarios_id'] == null){
            header('Location: /');
            exit();
        }

        // Creamos un array para almacenar los datos de la skill
        $data['nombre'] = "";
        $data['categoria']="";
        $data['skill'] = "";
        $data['categorias_skills'] = "";
        $skills = Skills::getInstancia()->getById($id);
        $categorias_skils = CategoriasSkills::getInstancia();
        // var_dump($skills);
        $data['skill'] = $skills[0];
        $data['categorias_skills'] = $categorias_skils->get();

        // Si se ha pulsado el botón de modificar
        if(isset($_POST['modificar'])){
            if($_POST['nombre'] ==""){
                $data['nombre'] = $skills[0]['nombre'];
            }else{
                $data['nombre'] = $_POST['nombre'];
            }
            $data['categoria'] = $_POST['categoria'];

            // var_dump($data['categoria']);

            // Modificamos la skill
            $skill = Skills::getInstancia();
            $skill->setHabilidades($data['nombre']);
            $skill->setCategoriasSkillCategoria($data['categoria']);
            $skill->edit($id);
            header('Location: /perfil/');
        }
        $this->renderHTML('../app/views/modificar_skill_view.php', $data);
    }

    // Modificar un usuario
    public function modificarUsuarioAction() {
        // Comprobamos que el usuario esté logueado
        if (strlen($_SESSION['id']) == 0) {
            header('Location: /');
            exit();
        }
        $lprocesaFormulario = false;
        $data = array();
        $data['nombre'] = $data['apellidos'] = $data['email'] = $data['categoria_profesional'] = $data['resumen_perfil'] = $data['picture'] = '';
        $data['msjErrorNombre'] = $data['msjErrorApellidos'] = $data['msjErrorEmail'] = $data['msjErrorImagen'] = '';
        
$img = false;

        if (!empty($_POST)) {
            // Saneamos las entradas antes de utilizarlas
            $data['nombre'] = $_POST['nombre'];
            $data['apellidos'] = $_POST['apellidos'];
            $data['email'] = $_POST['email'];
            $data['resumen_perfil'] = $_POST['resumen_perfil'];
            $data['categoria_profesional'] = $_POST['categoria_profesional'];
            $data['picture'] = $_FILES['foto'];
    
            // Creamos una instancia de usuarios
            $usuario1 = Users::getInstancia();
            $resultado = $usuario1->getUsuarioById($_SESSION['id']);
    
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
                $foto = $resultado['foto'];
            }
            $usuario1->setNombre($data['nombre']);
            $usuario1->setApellidos($data['apellidos']);
            $usuario1->setFoto($foto);
            $usuario1->setCategoriaProfesional($data['categoria_profesional']);
            $usuario1->setEmail($data['email']);
            $usuario1->setResumenPerfil($data['resumen_perfil']);
            $usuario1->edit($_SESSION['id']);
            header('Location: /perfil/');
        } else {
            $usuario1 = Users::getInstancia();
            $resultado = $usuario1->getUsuarioById($_SESSION['id']);
            $data['usuario'] = $resultado;
            $this->renderHTML('../app/views/modificar_usuario_view.php', $data);
        }
    }
}