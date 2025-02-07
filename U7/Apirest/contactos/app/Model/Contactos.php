<?php

namespace App\Model;
require_once('DBAbstractModel.php');

class Contactos extends DBAbstractModel{
 
    // modelo singlenton
    private static $instancia;
    public static function getInstancia(){
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    public function __clone(){
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }

    public function set($sh_data=array())
    {
        foreach($sh_data as $campo=>$valor){
            $$campo = $valor;
        }

        $this->query = "INSERT INTO contactos (nombre, telefono, email) VALUES (:nombre, :telefono, :email)";
        $this->parametros["nombre"] = $nombre;
        $this->parametros["telefono"] = $telefono;
        $this->parametros["email"] = $email;
        $this->get_results_from_query();
        $this->mensaje = 'Contacto agregado exitosamente';
    }

    public function get($id='')
    {
        if($id != ''){
            $this->query = "SELECT * FROM contactos WHERE id = :id";
            $this->parametros["id"] = $id;
            $this->get_results_from_query();
        }
        if(count($this->rows) == 1){
            foreach($this->rows[0] as $campo=>$valor){
                $this->$campo = $valor;
            }
            $this->mensaje = 'SH encontrado';
        }else{
            $this->mensaje = 'SH no encontrado';
        }
        return $this->rows[0]??null;
    }

    public function edit($dataCont=array()){

        foreach ($dataCont as $campo=>$valor) {
            $$campo = $valor;
        }

        $this->query = "UPDATE contactos SET nombre = :nombre, telefono = :telefono, email = :email WHERE id = :id";
        $this->parametros['nombre'] = $nombre;
        $this->parametros['telefono'] = $telefono;
        $this->parametros['email'] = $email;
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        // $this->execute_single_query();
        $this->mensaje = 'Contacto modificado';

    }

    public function delete($id = '') {
        $this->query = "DELETE FROM contactos WHERE id = :id";
        $this->parametros["id"] = $id;
        $this->get_results_from_query();
        $this->mensaje = 'Contacto eliminado exitosamente';
    }

}