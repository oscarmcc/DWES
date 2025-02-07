<?php

namespace App\Controllers;
use App\Model\Users;
use App\Model\Proyectos;
use App\Model\Trabajos;
use App\Model\Redes;
use App\Model\Skills;
use App\Model\CategoriasSkills;

class EliminarController extends BaseController
{
    // Eliminar una red social
    public function eliminarRedAction(){
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos que el usuario que intenta eliminar la red social es el propietario de la misma
        $idRedcomprobacion = Redes::getInstancia()->get($id);
        if($idRedcomprobacion[0]['usuarios_id'] != $_SESSION['id'] || $idRedcomprobacion[0]['usuarios_id'] == null){
            header('Location: /');
        }
        $red = Redes::getInstancia();
        $red->delete($id);
        header('Location: /perfil/');
    }
    
    // Eliminar una skill
    public function eliminarSkillAction(){
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos que el usuario que intenta eliminar la skill es el propietario de la misma
        $idSkillcomprobacion = Skills::getInstancia()->getById($id);
        if($idSkillcomprobacion[0]['usuarios_id'] != $_SESSION['id'] || $idSkillcomprobacion[0]['usuarios_id'] == null){
            header('Location: /');
        }
        $skill = Skills::getInstancia();
        $skill->delete($id);
        header('Location: /perfil/');
    }

    // Eliminar una categoria de skill
    public function eliminarTrabajoAction(){
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos que el usuario que intenta eliminar el trabajo es el propietario del mismo
        $idTrabajocomprobacion = Trabajos::getInstancia()->get($id);
        if($idTrabajocomprobacion[0]['usuarios_id'] != $_SESSION['id'] || $idTrabajocomprobacion[0]['usuarios_id'] == null){
            header('Location: /');
        }
        $trabajo = Trabajos::getInstancia();
        $trabajo->delete($id);
        header('Location: /perfil/');
    }

    // Eliminar un proyecto
    public function eliminarProyectoAction(){
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos que el usuario que intenta eliminar el proyecto es el propietario del mismo
        $idProyectocomprobacion = Proyectos::getInstancia()->get($id);
        if($idProyectocomprobacion[0]['usuarios_id'] != $_SESSION['id'] || $idProyectocomprobacion[0]['usuarios_id'] == null){
            header('Location: /');
        }
        $proyecto = Proyectos::getInstancia();
        $proyecto->delete($id);
        header('Location: /perfil/');
    }

    // Eliminar un usuario
    public function eliminarUsuarioAction(){
        $usuario1 = Users::getInstancia();
        $usuario1->delete($_SESSION['id']);
        $data = [];
        session_start();
        session_unset();
        session_destroy();
        header('Location: /');
    }
}