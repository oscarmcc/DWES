<?php
namespace App\Controllers;
use App\Model\Users;
use App\Model\Proyectos;
use App\Model\Trabajos;
use App\Model\Redes;
use App\Model\Skills;
use App\Model\CategoriasSkills;

class VisibilizarController extends BaseController
{
    // Función para visibilizar o no visibilizar un trabajo
    public function visibleSkillAction(){
        $idSkill = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos si el usuario está logueado
        $idSkillcomprobacion = Skills::getInstancia()->getById($idSkill);
        if($idSkillcomprobacion[0]['usuarios_id'] != $_SESSION['id'] || $idSkillcomprobacion[0]['usuarios_id'] == null){
            header('Location: /');
        }

        // Creamos un array para almacenar los datos del formulario
        $skill = Skills::getInstancia();
        $usuarioskill = $skill->getById($idSkill);
        // var_dump($usuarioskill);

        // Comprobamos si el skill está visible o no y lo cambiamos
        if($usuarioskill[0]['visible'] == 1){
            $skill->visibilizar(0,$idSkill);

            header('Location: /perfil/');
        }else{
            $skill->visibilizar(1,$idSkill);
            header('Location: /perfil/');
        }
    }

    // Función para visibilizar o no visibilizar un proyecto
    public function visibleProyectoAction(){
        $idProyecto = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos si el usuario está logueado
        $idProyectoComprobacion = Proyectos::getInstancia()->get($idProyecto);
        if($idProyectoComprobacion[0]['usuarios_id'] != $_SESSION['id'] || $idProyectoComprobacion[0]['usuarios_id'] == null){
            header('Location: /');
        }

        // Creamos un array para almacenar los datos del formulario
        $proyecto = Proyectos::getInstancia();
        $usuarioproyecto = $proyecto->get($idProyecto);
        // var_dump($usuarioproyecto);
        // var_dump($proyecto);

        // Comprobamos si el proyecto está visible o no y lo cambiamos
        if($usuarioproyecto[0]['visible'] == 1){
            $proyecto->visibilizar(0,$idProyecto);
            header('Location: /perfil/');
        }else{
            $proyecto->visibilizar(1,$idProyecto);
            header('Location: /perfil/');
        }
    }

    // Función para visibilizar o no visibilizar un trabajo
    public function visibleTrabajoAction(){
        $idTrabajo = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos si el usuario está logueado
        $idTrabajoComprobacion = Trabajos::getInstancia()->get($idTrabajo);
        if($idTrabajoComprobacion[0]['usuarios_id'] != $_SESSION['id'] || $idTrabajoComprobacion[0]['usuarios_id'] == null){
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


    // Función para visibilizar el usuario que este iniciado sesion
    public function visibleAction()
    {
        $usuario1 = Users::getInstancia();
        $usuario1->setVisibilidad(1,$_SESSION['id']);
        header('Location: /perfil/');
    }

    // Función para no visibilizar el usuario que este iniciado sesion
    public function novisibleAction()
    {
        $usuario1 = Users::getInstancia();
        $usuario1->setVisibilidad(0,$_SESSION['id']);
        header('Location: /perfil/');
    }
}