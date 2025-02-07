<?php
namespace App\Model;
require_once('DBAbstractModel.php');

class Proyectos extends DBAbstractModel
{
    /*CONSTRUCCIÓN DEL MODELO
    SINGLETON*/
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
    private $titulo;
    private $descripcion;
    private $logo;
    private $tecnologias;
    private $visible;
    private $created_at;
    private $updated_at;
    private $usuarios_id;

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }
    public function setTecnologias($tecnologias)
    {
        $this->tecnologias = $tecnologias;
    }
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }
    public function setUsuariosId($usuarios_id)
    {
        $this->usuarios_id = $usuarios_id;
    }

    public function visibilizar($visible,$id){
        $this->query = "UPDATE proyectos SET visible=:visible WHERE id=:id";
        $this->parametros['id'] = $id;
        $this->parametros['visible'] = $visible;
        $this->get_results_from_query();
    }
    
    public function set(){
        $fecha = new \DateTime();
        $this->query = "INSERT INTO proyectos (titulo, descripcion, logo, tecnologias, visible, created_at, usuarios_id) VALUES (:titulo, :descripcion, :logo, :tecnologias, :visible, :created_at, :usuarios_id)";
        $this->parametros['titulo'] = $this->titulo;
        $this->parametros['descripcion'] = $this->descripcion;
        $this->parametros['logo'] = $this->logo;
        $this->parametros['tecnologias'] = $this->tecnologias;
        $this->parametros['visible'] = $this->visible;
        $this->parametros['created_at'] = $fecha->format('Y-m-d H:i:s');
        $this->parametros['usuarios_id'] = $this->usuarios_id;
        $this->get_results_from_query();
        $this->mensaje = 'Proyecto guardado';
    }

    public function getProyectosByUsuarioId($usuarios_id=''){
        $this->query = "SELECT * FROM proyectos WHERE usuarios_id = :usuarios_id";
        $this->parametros['usuarios_id'] = $usuarios_id;
        $this->get_results_from_query();
        if(count($this->rows) > 0){
            $this->mensaje = 'Proyectos encontrados';
            return $this->rows;
        }
        $this->mensaje = 'Proyectos no encontrados';
        return [];
    }
    public function get($id=''){
        if($id != ''){
            $this->query = "SELECT * FROM proyectos WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
            if(count($this->rows) > 0){
                $this->mensaje = 'Proyecto encontrado';
                return $this->rows;
            }
            $this->mensaje = 'Proyecto no encontrado';
            return [];
        }
        $this->query = "SELECT * FROM proyectos";
        $this->get_results_from_query();
        if(count($this->rows) > 0){
            $this->mensaje = 'Proyectos encontrados';
            return $this->rows;
        }
        $this->mensaje = 'Proyectos no encontrados';
        return [];
    }
    public function delete($id=''){
        $this->query = "DELETE FROM proyectos WHERE id=:id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = 'Proyecto eliminado';
    }
    public function edit($id=''){
        $this->query = "UPDATE proyectos SET titulo=:titulo, descripcion=:descripcion, logo=:logo, tecnologias=:tecnologias, visible=:visible, updated_at=:updated_at WHERE id=:id";
        $this->parametros['titulo'] = $this->titulo;
        $this->parametros['descripcion'] = $this->descripcion;
        $this->parametros['logo'] = $this->logo;
        $this->parametros['tecnologias'] = $this->tecnologias;
        $this->parametros['visible'] = $this->visible;
        $this->parametros['updated_at'] = $this->updated_at;
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = 'Proyecto modificado';
    }
}