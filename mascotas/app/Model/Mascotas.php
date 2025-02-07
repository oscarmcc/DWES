<?php
require_once('DBAbstractModel.php');

class Mascotas extends DBAbstractModel
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
    private $nombre;
    private $peso;
    private $raza;
    private $created_at;
    private $updated_at;

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setRaza($raza)
    {
        $this->raza = $raza;
    }
    public function setPeso($peso)
    {
        $this->peso = $peso;
    }

    public function set() {
        $this->query = "INSERT INTO perros(nombre, raza, peso)
        VALUES(:nombre, :raza, :peso)";
        
        //$this->parametros['id']= $id;
        $this->parametros['nombre']= $this->nombre;
        $this->parametros['raza']= $this->raza;
        $this->parametros['peso']= $this->peso;
        $this->get_results_from_query();
        //$this->execute_single_query();
        $this->mensaje = 'Mascota añadido.';
        }

    public function get($id=''){
        if($id != ''){
            $this->query = "SELECT * FROM perros WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
            if(count($this->rows) == 1){
                foreach ($this->rows[0] as $propiedad=>$valor){
                    $this->$propiedad = $valor;
                }
                $this->mensaje = 'Mascota encontrada';
        }else{
            $this->mensaje = 'Mascota no encontrada';
        }
        return $this->rows[0]??null;
    }}

    public function edit(){
        $fecha =new Datetime();
        $this->query = "UPDATE perros SET nombre=:nombre, raza=:raza, peso=:peso, updated_at = :updated_at WHERE id=:id"; // now() en lugar de el update_at
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['raza'] = $this->raza;
        $this->parametros['peso'] = $this->peso;
        $this->parametros['updated_at'] = date('Y-m-d H:i:s', $fecha->getTimestamp());
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Mascota modificada';
    }

    public function delete($id=''){
        // Sin pasarle el id
        // $this->query = "DELETE FROM perros WHERE id = :id";
        // $this->parametros['id'] = $this->id;
        // $this->get_results_from_query();
        // $this->mensaje = 'Mascota eliminada';

        // pasandole el id
        $this->query = "DELETE FROM perros WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = 'Mascota eliminada';
    }
}
