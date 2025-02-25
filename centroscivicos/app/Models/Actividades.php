<?php
namespace App\Models;

class Actividades extends DBAbstractModel{
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

    }

    public function get($data = array()){
    
        // var_dump($sh_data); die();

        foreach ($data as $campo=>$valor) {
            $$campo = $valor;
        }
    
        if(isset($id)){
            $this->query = "SELECT * FROM actividades WHERE id_centro_civico = :id_centro_civico";

            // Cargamos los parametros
            $this->parametros['id_centro_civico'] = $id;

        }

        // Ejecutamos la consulta
        $this->get_results_from_query();

        if(count($this->rows) == 1){
            foreach ($this->rows[0] as $propiedad=>$valor){
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Actividades encontrado';
        } else {
            $this->mensaje = 'Actividades no encontrado';
        }
        return $this->rows ?? null;
    }

    public function getByFilter($data = array()){
        if (!is_array($data)) {
            return null;
        }

        foreach ($data as $campo=>$valor) {
            $$campo = $valor;
        }

        $nombre = $data['nombre'] ?? '';
        $descripcion = $data['descripcion'] ?? '';
        $fecha_inicio = $data['fecha_inicio'] ?? '';
        $fecha_final = $data['fecha_final'] ?? '';
        $horario = $data['horario'] ?? '';
        $plazas = $data['plazas'] ?? '';

        switch (true) {
            case !empty($nombre):
                $this->query = "SELECT nombre, descripcion, fecha_inicio, fecha_final, horario, plazas FROM actividades WHERE nombre LIKE :nombre";
                $this->parametros['nombre'] = '%'.$nombre.'%';
                break;

            case !empty($descripcion):
                $this->query = "SELECT nombre, descripcion, fecha_inicio, fecha_final, horario, plazas FROM actividades WHERE descripcion LIKE :descripcion";
                $this->parametros['descripcion'] = '%'.$descripcion.'%';
                break;

            case !empty($fecha_inicio):
                $this->query = "SELECT nombre, descripcion, fecha_inicio, fecha_final, horario, plazas FROM actividades WHERE fecha_inicio = :fecha_inicio";
                $this->parametros['fecha_inicio'] = $fecha_inicio;
                break;

            case !empty($fecha_final):
                $this->query = "SELECT nombre, descripcion, fecha_inicio, fecha_final, horario, plazas FROM actividades WHERE fecha_final = :fecha_final";
                $this->parametros['fecha_final'] = $fecha_final;
                break;

            case !empty($horario):
                $this->query = "SELECT nombre, descripcion, fecha_inicio, fecha_final, horario, plazas FROM actividades WHERE horario LIKE :horario";
                $this->parametros['horario'] = '%'.$horario.'%';
                break;

            case !empty($plazas):
                $this->query = "SELECT nombre, descripcion, fecha_inicio, fecha_final, horario, plazas FROM actividades WHERE plazas = :plazas";
                $this->parametros['plazas'] = $plazas;
                break;

            default:
                return null;
        }

        // Ejecutamos la consulta
        $this->get_results_from_query();

        if(count($this->rows) > 0){
            $this->mensaje = 'Actividades encontradas';
        } else {
            $this->mensaje = 'Actividades no encontradas';
        }
        return $this->rows ?? null;
    }

    public function edit($id = '', $data = array()){
    }

    public function delete($id = ''){

    }
}