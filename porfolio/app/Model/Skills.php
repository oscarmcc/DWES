<?php
namespace App\Model;

class Skills extends DBAbstractModel
{
    /*CONSTRUCCIÓN DEL MODELO SINGLETON*/
    private static $instancia;
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    public function __clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }
    private $id;
    private $habilidades;
    private $usuarios_id;
    private $created_at;
    private $updated_at;
    private $visible;
    private $categorias_skill_categoria;
    public function setHabilidades($habilidades)
    {
        $this->habilidades = $habilidades;
    }
    public function setUsuariosId($usuarios_id)
    {
        $this->usuarios_id = $usuarios_id;
    }
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }
    public function setCategoriasSkillCategoria($categorias_skill_categoria)
    {
        $this->categorias_skill_categoria = $categorias_skill_categoria;
    }

    public function visibilizar($visible,$id){
        $this->query = "UPDATE skills SET visible=:visible WHERE id=:id";
        $this->parametros['id'] = $id;
        $this->parametros['visible'] = $visible;
        $this->get_results_from_query();
    }
    public function set(){
        $fecha = new \DateTime();
        $this->query = "INSERT INTO skills (habilidades, created_at, usuarios_id, visible, categorias_skill_categoria) VALUES (:habilidades, :created_at, :usuarios_id, :visible, :categorias_skill_categoria)";
        $this->parametros['habilidades'] = $this->habilidades;
        $this->parametros['created_at'] = $fecha->format('Y-m-d H:i:s');
        $this->parametros['usuarios_id'] = $this->usuarios_id;
        $this->parametros['visible'] = $this->visible;
        $this->parametros['categorias_skill_categoria'] = $this->categorias_skill_categoria;
        $this->get_results_from_query();
        $this->mensaje = 'Habilidad guardada';
    }

    public function getSkillsByUsuarioId($usuario_id=''){
        if($usuario_id != ''){
            $this->query = "SELECT * FROM skills WHERE usuarios_id = :usuarios_id";
            $this->parametros['usuarios_id'] = $usuario_id;
            $this->get_results_from_query();
            if(count($this->rows) > 0){
                $this->mensaje = 'Skills encontradas';
                return $this->rows;
            }
            $this->mensaje = 'Skills no encontradas';
            return [];
        }
        $this->mensaje = 'Usuario no encontrado';
        return [];
    }

    public function getById($id=''){
        if($id != ''){
            $this->query = "SELECT * FROM skills WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
            if(count($this->rows) > 0){
                $this->mensaje = 'Skill encontrada';
                return $this->rows;
            }
            $this->mensaje = 'Skill no encontrada';
            return [];
        }
        $this->mensaje = 'Skill no encontrada';
        return [];
    }
    public function get($id=''){
        if($id != ''){
            $this->query = "SELECT * FROM skills WHERE usuarios_id = :usuarios_id";
            $this->parametros['usuarios_id'] = $id;
            $this->get_results_from_query();
            if(count($this->rows) > 0){
                $this->mensaje = 'Habilidades encontradas';
                return $this->rows;
            }
            $this->mensaje = 'Skill no encontrada';
            return [];
        }
        $this->query = "SELECT * FROM skills";
        $this->get_results_from_query();
        if(count($this->rows) > 0){
            $this->mensaje = 'Skills encontradas';
            return $this->rows;
        }
        $this->mensaje = 'Skills no encontradas';
        return [];
            
    }
    public function edit($id=''){
        if($id != ''){
            $this->query = "UPDATE skills SET habilidades=:habilidades, updated_at=:updated_at ,categorias_skill_categoria=:categorias_skill_categoria WHERE id=:id";
            $this->parametros['id'] = $id;
            $this->parametros['habilidades'] = $this->habilidades;
            $this->parametros['categorias_skill_categoria'] = $this->categorias_skill_categoria;
            $this->parametros['updated_at'] = date('Y-m-d H:i:s');
            $this->get_results_from_query();
            $this->mensaje = 'Habilidad modificada';
        }
    }

    public function delete($id=''){
        if($id != ''){
            $this->query = "DELETE FROM skills WHERE id=:id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
            $this->mensaje = 'Habilidad eliminada';
        }
    }
}
?>