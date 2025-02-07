<?php

namespace App\Model;
require_once('DBAbstractModel.php');

class Usuarios extends DBAbstractModel{
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

    public function getLogin($usuario , $password){
        $this->query = "SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password";
        $this->parametros['usuario'] = $usuario;
        $this->parametros['password'] = $password;
        $this->get_results_from_query();
        return $this->rows[0]??null;
    }

    public function set(){}
    public function get(){}
    public function edit(){}
    public function delete(){}
}