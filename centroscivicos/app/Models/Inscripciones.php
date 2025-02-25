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

        $this->query = "INSERT INTO inscripciones (nombre,telefono,email,id_actividad,fecha,estado) 
                        VALUES (:nombre, :telefono, :email, :id_actividad, :fecha, :estado)";
        $this->parametros['nombre'] = $nombre;
        $this->parametros['telefono'] = $telefono;
        $this->parametros['email'] = $email;
        $this->parametros['id_actividad'] = $id_actividad;
        $this->parametros['fecha'] = $fecha;
        $this->parametros['estado'] = $estado;
        $this->get_results_from_query();
        $this->mensaje = "Inscripción agregada";
    }

    public function get($id = ''){
    }

    public function edit($id = '', $data = array()){

    }

    public function delete($id = ''){
        $this->query = "DELETE FROM inscripciones WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
    }
}
?>