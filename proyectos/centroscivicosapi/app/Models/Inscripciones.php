<?php
namespace App\Models;

class Inscripciones extends DBAbstractModel{
    private static $instancia;

    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    public function set($data = array()){
        foreach ($data as $campo => $valor) {
            $$campo = $valor;
        }

        $this->query = "INSERT INTO inscripciones (nombre,telefono,email,id_actividad,fecha,estado, user_id) 
                        VALUES (:nombre, :telefono, :email, :id_actividad, :fecha, :estado, :user_id)";
        $this->parametros['user_id'] = $user_id;
        $this->parametros['nombre'] = $nombre;
        $this->parametros['telefono'] = $telefono;
        $this->parametros['email'] = $email;
        $this->parametros['id_actividad'] = $id_actividad;
        $this->parametros['fecha'] = $fecha;
        $this->parametros['estado'] = $estado;
        $this->get_results_from_query();
        $this->mensaje = "Inscripción agregada";
    }

    public function get($data = array()){
        foreach ($data as $campo => $valor) {
            $$campo = $valor;
        }

        if(isset($user_id)){
            $this->query = "SELECT * FROM inscripciones WHERE user_id = :user_id";
            $this->parametros['user_id'] = $user_id;
        }

        if(isset($id)){
            $this->query = "SELECT * FROM inscripciones WHERE id = :id";
            $this->parametros['id'] = $id;
        }

        $this->get_results_from_query();

        if(count($this->rows) == 1){
            $this->mensaje = "Inscripción encontrada";
        }else{
            $this->mensaje = "Inscripción no encontrada";
        }

        return $this->rows;
    }

    public function getPlazas($id=''){
        $this->query = "SELECT plazas FROM actividades WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();

        if(count($this->rows) == 1){
            $this->mensaje = "Plazas encontradas";
        }else{
            $this->mensaje = "Plazas no encontradas";
        }
        return $this->rows[0]['plazas'];
    }

    public function getInscripcionesPorActividad($data = array()){
        foreach ($data as $campo => $valor) {
            $$campo = $valor;
        }

        $this->query = "SELECT COUNT(*) as count FROM inscripciones WHERE id_actividad = :id_actividad";
        $this->parametros['id_actividad'] = $id_actividad;
        $this->get_results_from_query();

        return $this->rows[0]['count'];
    }

    public function edit($id = '', $data = array()){
    }


    public function delete($id = ''){
        $this->query = "DELETE FROM inscripciones WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = "Inscripción eliminada";
    }
}
?>