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

        $this->query = "INSERT INTO reservas (nombre,telefono,email,id_instalacion,fecha_hora_inicio,fecha_hora_final,estado,user_id) 
                        VALUES (:nombre, :telefono, :email, :id_instalacion, :fecha_hora_inicio, :fecha_hora_final, :estado, :user_id)";
        $this->parametros['user_id'] = $user_id;
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

    public function get($sh_data = array()){
    
        // var_dump($sh_data); die();

        foreach ($sh_data as $campo=>$valor) {
            $$campo = $valor;
        }
    
        if(isset($user_id)){
            $this->query = "SELECT * FROM reservas WHERE user_id= :user_id";

            // Cargamos los parametros
            $this->parametros['user_id'] = $user_id;

        }

        if(isset($id)){
            $this->query = "SELECT * FROM reservas WHERE id= :id";

            // Cargamos los parametros
            $this->parametros['id'] = $id;

        }

        // Ejecutamos la consulta
        $this->get_results_from_query();

        if(count($this->rows) == 1){
            foreach ($this->rows[0] as $propiedad=>$valor){
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Instalaciones encontrado';
        } else {
            $this->mensaje = 'Instalaciones no encontrado';
        }
        return $this->rows ?? null;
    }

    public function edit(){
    }

    public function delete($data = array()){
        foreach ($data as $campo => $valor) {
            $$campo = $valor;
        }

        $this->query = "DELETE FROM reservas WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = "Reserva eliminada";
    }
}
?>