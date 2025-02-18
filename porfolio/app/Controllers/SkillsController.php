<?php 

namespace App\Controllers;

use App\Model\Skills;
use App\Model\CategoriasSkills;

class SkillsController extends BaseController{
    public function setSkillsAction(){
        // Comprobamos si el usuario está logueado
        if(empty($_SESSION['id'])){
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

    public function visibleSkillAction(){
        $idSkill = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos si el usuario está logueado
        $idSkillcomprobacion = Skills::getInstancia()->getById($idSkill);
        if($idSkillcomprobacion[0]['usuarios_id'] != $_SESSION['id']){
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

    public function modificarSkillAction(){
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos que el usuario que intenta modificar la skill es el propietario de la misma
        $skills = Skills::getInstancia()->getById($id);
        if($skills[0]['usuarios_id'] != $_SESSION['id']){
            header('Location: /');
            exit();
        }

        // Creamos un array para almacenar los datos de la skill
        $data['nombre'] = "";
        $data['categoria']="";
        $data['skill'] = "";
        $data['categorias_skills'] = "";
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

    public function eliminarSkillAction(){
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];

        // Comprobamos que el usuario que intenta eliminar la skill es el propietario de la misma
        $idSkillcomprobacion = Skills::getInstancia()->getById($id);
        if($idSkillcomprobacion[0]['usuarios_id'] != $_SESSION['id']){
            header('Location: /');
        }
        $skill = Skills::getInstancia();
        $skill->delete($id);
        header('Location: /perfil/');
    }
}

?>