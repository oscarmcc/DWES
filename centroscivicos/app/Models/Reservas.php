<?php
namespace App\Models;

class Reservas extends DBAbstractModel{
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

        $this->query = "INSERT INTO reservas (nombre,telefono,email,id_instalacion,fecha_hora_inicio,fecha_hora_final,estado) 
                        VALUES (:nombre, :telefono, :email, :id_instalacion, :fecha_hora_inicio, :fecha_hora_final, :estado)";
        $this->parametros['nombre'] = $nombre;
        $this->parametros['telefono'] = $telefono;
        $this->parametros['email'] = $email;
        $this->parametros['id_instalacion'] = $id_instalacion;
        $this->parametros['fecha_hora_inicio'] = $fecha_hora_inicio;
        $this->parametros['fecha_hora_final'] = $fecha_hora_final;
        $this->parametros['estado'] = $estado;
        $this->get_results_from_query();
        $this->mensaje = "Reserva agregada";
    }

    public function get($id = ''){
        if ($id != '') {
            $this->query = "SELECT * FROM reservas WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
        }
        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad => $valor) {
                // $this->$propiedad = $valor;
            }
            $this->mensaje = "Reserva encontrada";
        } else {
            $this->mensaje = "Reserva no encontrada";
        }
        return $this->rows[0]??null;
    }

    public function edit(){
    }

    public function delete($id = ''){
        $this->query = "DELETE FROM reservas WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
    }
}
?>