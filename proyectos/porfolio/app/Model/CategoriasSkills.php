<?php

namespace  App\Model;

class CategoriasSkills extends DBAbstractModel
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

    private $categoria;

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function set(){
        $this->query = "INSERT INTO categorias_skills (categoria) VALUES (:categoria)";
        $this->parametros['categoria'] = $this->categoria;
        $this->get_results_from_query();
        $this->mensaje = 'Categoría guardada';
    }

    public function get(){
        $this->query = "SELECT * FROM categorias_skills";
        $this->get_results_from_query();
        if(count($this->rows) > 0){
            $this->mensaje = 'Redes sociales encontradas';
            return $this->rows;
        }
        $this->mensaje = 'Redes sociales no encontradas';
        return [];
    }

    public function edit(){
        $this->query = "UPDATE categorias_skills SET categoria = :categoria WHERE categoria = :categoria";
        $this->parametros['categoria'] = $this->categoria;
        $this->get_results_from_query();
        $this->mensaje = 'Categoría actualizada';
    }

    public function delete(){
        $this->query = "DELETE FROM categorias_skills WHERE categoria = :categria";
        $this->parametros['categoria'] = $this->categoria;
        $this->get_results_from_query();
        $this->mensaje = 'Categoría eliminada';
    }

}

?>