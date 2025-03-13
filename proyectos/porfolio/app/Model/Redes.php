<?php

namespace App\Model;

class Redes extends DBAbstractModel
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
    private $redes_socialcol;
    private $url;
    private $usuarios_id;
    private $created_at;
    private $updated_at;

    public function setRedesSocialcol($redes_socialcol)
    {
        $this->redes_socialcol = $redes_socialcol;
    }
    public function setUrl($url)
    {
        $this->url = $url;
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

    public function set(){
        $fecha = new \DateTime();
        $this->query = "INSERT INTO redes_sociales (redes_socialescol, url, created_at, usuarios_id) VALUES (:redes_socialescol, :url, :created_at, :usuarios_id)";
        $this->parametros['redes_socialescol'] = $this->redes_socialcol;
        $this->parametros['url'] = $this->url;
        $this->parametros['created_at'] = $fecha->format('Y-m-d H:i:s');
        $this->parametros['usuarios_id'] = $this->usuarios_id;
        $this->get_results_from_query();
        $this->mensaje = 'Red social guardada';
    }

    public function getRedesByUsuarioId($usuario_id){
        $this->query = "SELECT * FROM redes_sociales WHERE usuarios_id = :usuarios_id";
        $this->parametros['usuarios_id'] = $usuario_id;
        $this->get_results_from_query();
        if(count($this->rows) > 0){
            $this->mensaje = 'Redes sociales encontradas';
            return $this->rows;
        }
        $this->mensaje = 'Redes sociales no encontradas';
        return [];
    }
    public function get($id=''){
        if($id != ''){
            $this->query = "SELECT * FROM redes_sociales WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
            if(count($this->rows) > 0){
                $this->mensaje = 'Red social encontrada';
                return $this->rows;
            }
            $this->mensaje = 'Red social no encontrada';
            return [];
        }
        $this->query = "SELECT * FROM redes_sociales";
        $this->get_results_from_query();
        if(count($this->rows) > 0){
            $this->mensaje = 'Redes sociales encontradas';
            return $this->rows;
        }
        $this->mensaje = 'Redes sociales no encontradas';
        return [];
    }

    public function edit($id=''){
        $fecha = new \DateTime();
        $this->query = "UPDATE redes_sociales SET redes_socialescol=:redes_socialescol, url=:url, updated_at=:updated_at WHERE id=:id";
        $this->parametros['id'] = $id;
        $this->parametros['redes_socialescol'] = $this->redes_socialcol;
        $this->parametros['url'] = $this->url;
        $this->parametros['updated_at'] = $fecha->format('Y-m-d H:i:s');
        $this->get_results_from_query();
        $this->mensaje = 'Red social modificada';
    }

    public function delete($id=''){
        $this->query = "DELETE FROM redes_sociales WHERE id=:id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = 'Red social eliminada';
    }
}