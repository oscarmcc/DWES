<?php
namespace App\Models;

class Centros_Civicos extends DBAbstractModel{
    private static $instancia;

    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    public function getAll(){
        $this->query = "SELECT * FROM centros_civicos";
        $this->get_results_from_query();
        return $this->rows;
    }


    public function get($data=array()){
        foreach ($data as $campo=>$valor) {
            $$campo = $valor;
        }

        if(isset($id)){
            $this->query = "SELECT * FROM centros_civicos WHERE id = :id";
            $this->parametros['id'] = $id;
        }

        $this->get_results_from_query();
        if(count($this->rows) == 1){
            foreach ($this->rows[0] as $propiedad=>$valor){
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Centro Civico encontrado';
        } else {
            $this->mensaje = 'Centro Civico no encontrado';
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
?>