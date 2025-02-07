<?php
namespace App\Model;
class Trabajos extends DBAbstractModel{
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
    private $titulo;
    private $descripcion;
    private $fecha_inicio;
    private $fecha_final;
    private $logros;
    private $usuarios_id;
    private $created_at;
    private $updated_at;
    private $visible;

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function setFechaInicio($fecha_inicio)
    {
        $this->fecha_inicio = $fecha_inicio;
    }
    public function setFechaFinal($fecha_final)
    {
        $this->fecha_final = $fecha_final;
    }
    public function setLogros($logros)
    {
        $this->logros = $logros;
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

    public function visibilizar($visible,$id){
        $this->query = "UPDATE trabajos SET visible=:visible WHERE id=:id";
        $this->parametros['id'] = $id;
        $this->parametros['visible'] = $visible;
        $this->get_results_from_query();
    }

    public function set(){
        $fecha = new \DateTime();
        $this->query = "INSERT INTO trabajos (titulo, descripcion, fecha_inicio, fecha_final, logros, visible, created_at, usuarios_id) VALUES (:titulo, :descripcion, :fecha_inicio, :fecha_final, :logros, :visible, :created_at, :usuarios_id)";
        $this->parametros['titulo'] = $this->titulo;
        $this->parametros['descripcion'] = $this->descripcion;
        $this->parametros['logros'] = $this->logros;
        $this->parametros['visible'] = $this->visible;
        $this->parametros['created_at'] = $fecha->format('Y-m-d H:i:s');
        $this->parametros['usuarios_id'] = $this->usuarios_id;

        if ($this->fecha_inicio != '') {
            $fecha_inicio_dt = new \DateTime($this->fecha_inicio);
            $this->parametros['fecha_inicio'] = $fecha_inicio_dt->format('Y-m-d H:i:s');
        } else {
            $this->parametros['fecha_inicio'] = null;
        }

        if ($this->fecha_final != '') {
            $fecha_final_dt = new \DateTime($this->fecha_final);
            $this->parametros['fecha_final'] = $fecha_final_dt->format('Y-m-d H:i:s');
        } else {
            $this->parametros['fecha_final'] = null;
        }

        $this->get_results_from_query();
        $this->mensaje = 'Trabajo guardado';
    }

    public function getTrabajaosByUsuarioId($usuarios_id)
    {
        $this->query = "SELECT * FROM trabajos WHERE usuarios_id = :usuarios_id";
        $this->parametros['usuarios_id'] = $usuarios_id;
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            $this->mensaje = 'Trabajos encontrados';
            return $this->rows;
        }
        $this->mensaje = 'Trabajos no encontrados';
        return [];
    }
    public function get($id=''){
        if($id != ''){
            $this->query = "SELECT * FROM trabajos WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
            if(count($this->rows) == 1){
                foreach ($this->rows[0] as $propiedad=>$valor){
                    $this->$propiedad = $valor;
                }
                $this->mensaje = 'Trabajo encontrado';
        }else{
            $this->mensaje = 'Trabajo no encontrado';
        }
        return $this->rows[0]??null;
    }}

    public function edit($id=''){
        $fecha = new \DateTime();
        $this->query = "UPDATE trabajos SET titulo=:titulo, descripcion=:descripcion, fecha_inicio=:fecha_inicio, fecha_final=:fecha_final, logros=:logros, updated_at=:updated_at, visible=:visible WHERE id=:id";
        $this->parametros['id'] = $id;
        $this->parametros['titulo'] = $this->titulo;
        $this->parametros['descripcion'] = $this->descripcion;
        $this->parametros['logros'] = $this->logros;
        $this->parametros['visible'] = $this->visible;
        $this->parametros['updated_at'] = $fecha->format('Y-m-d H:i:s');

        if ($this->fecha_inicio != '') {
            $fecha_inicio_dt = new \DateTime($this->fecha_inicio);
            $this->parametros['fecha_inicio'] = $fecha_inicio_dt->format('Y-m-d H:i:s');
        } else {
            $this->parametros['fecha_inicio'] = null;
        }

        if ($this->fecha_final != '') {
            $fecha_final_dt = new \DateTime($this->fecha_final);
            $this->parametros['fecha_final'] = $fecha_final_dt->format('Y-m-d H:i:s');
        } else {
            $this->parametros['fecha_final'] = null;
        }

        $this->get_results_from_query();
        $this->mensaje = 'Trabajo modificado';
    }

    public function delete($id=''){
        $this->query = "DELETE FROM trabajos WHERE id=:id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = 'Trabajo eliminado';
    }

    public function getTrabajosByUsuario($usuarios_id)
    {
        $this->query = "SELECT * FROM trabajos WHERE usuarios_id = :usuarios_id";
        $this->parametros['usuarios_id'] = $usuarios_id;
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            $this->mensaje = 'Trabajos encontrados';
            return $this->rows;
        }
        $this->mensaje = 'Trabajos no encontrados';
        return [];
    }
}