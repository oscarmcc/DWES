<?php

namespace App\Models;
class Instalaciones extends DBAbstractModel{
    private static $instancia;

    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }


    public function get($data=array()){
        foreach ($data as $campo=>$valor) {
            $$campo = $valor;
        }

        if(isset($id_centro_civico)){
            $this->query = "SELECT * FROM instalaciones WHERE id_centro_civico = :id_centro_civico";
            $this->parametros['id_centro_civico'] = $id_centro_civico;
        }

        $this->get_results_from_query();
        if(count($this->rows) == 1){
            foreach ($this->rows[0] as $propiedad=>$valor){
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Instalacion encontrada';
        } else {
            $this->mensaje = 'Instalacion no encontrada';
        }
        return $this->rows ?? null;
        
    }

    public function getByFilter($data = array())
    {
        if (!is_array($data)) {
            return null;
        }
        $this->query = "SELECT nombre, descripcion, capacidad_maxima FROM instalaciones";
        $this->parametros = [];
        $conditions = [];

        if (!empty($data['nombre'])) {
            $conditions[] = "nombre LIKE :nombre";
            $this->parametros['nombre'] = '%' . $data['nombre'] . '%';
        }

        if (!empty($data['descripcion'])) {
            $conditions[] = "descripcion LIKE :descripcion";
            $this->parametros['descripcion'] = '%' . $data['descripcion'] . '%';
        }

        if (!empty($data['capacidad_maxima'])) {
            $conditions[] = "capacidad_maxima = :capacidad_maxima";
            $this->parametros['capacidad_maxima'] = $data['capacidad_maxima'];
        }

        // Si hay condiciones, las añadimos a la consulta con AND
        if (!empty($conditions)) {
            $this->query .= " WHERE " . implode(" AND ", $conditions);
        }

        $this->get_results_from_query();

        if (count($this->rows) > 0) {
            $this->mensaje = 'Instalaciones encontradas';
        } else {
            $this->mensaje = 'Instalaciones no encontradas';
        }
        return $this->rows ?? null;
    }

    public function set($data = array()){
        
    }

    public function edit($id = '', $data = array()){

    }

    public function delete($id = ''){

    }
}