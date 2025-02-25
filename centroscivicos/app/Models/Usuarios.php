<?php

namespace App\Models;

class Usuarios extends DBAbstractModel{
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
        $this->query = "SELECT * FROM usuarios";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function set($data = array()){
        foreach ($data as $campo => $valor) {
            $$campo = $valor;
        }

        $this->query = "INSERT INTO usuarios (nombre, email, password) 
                        VALUES (:nombre, :email, :password)";
        $this->parametros['nombre'] = $nombre;
        $this->parametros['email'] = $email;
        $this->parametros['password'] = $password;
        $this->get_results_from_query();
        $this->mensaje = "Usuario agregado";

        return $this->mensaje;
        
    }

    public function get($data = array()){
        foreach ($data as $campo => $valor) {
            $$campo = $valor;
        }

        if(isset($id)){
            $this->query = "SELECT * FROM usuarios WHERE id = :id";
            $this->parametros['id'] = $id;
        }elseif(isset($email)){
            $this->query = "SELECT * FROM usuarios WHERE email = :email";
            $this->parametros['email'] = $email;
        }else{
            return null;
        }

        $this->get_results_from_query();
        if(count($this->rows) == 1){
            foreach ($this->rows[0] as $propiedad => $valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = "Usuario encontrado";
        }else{
            $this->mensaje = "Usuario no encontrado";
        }
        return $this->rows[0]??null;
    }

    public function edit($data = array()){
        foreach ($data as $campo => $valor) {
            $$campo = $valor;
        }

        $this->query = "UPDATE usuarios SET nombre = :nombre, email = :email, password = :password WHERE id = :id";
        $this->parametros['nombre'] = $nombre;
        $this->parametros['email'] = $email;
        $this->parametros['password'] = $password;
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = "Usuario modificado";
    }

    public function delete($dataCont=array()){
        foreach ($dataCont as $campo=>$valor) {
            $$campo = $valor;
        }
        $this->query = "DELETE FROM Usuarios WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();

        $this->mensaje = 'Usuario eliminado';
        
    }

    public function login($email = '', $password = ''){
        if($email != '' && $password != ''){
            $this->query= "SELECT * FROM Usuarios WHERE email = :email AND password = :password";

            $this->parametros['email'] = $email;
            $this->parametros['password'] = $password;

            $this->get_results_from_query();
        }
        if(count($this->rows) == 1){
            foreach ($this->rows[0] as $propiedad => $valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = "Usuario encontrado";
        } else {
            $this->mensaje = 'Usuario no encontrado';
        }
        return $this->rows[0] ?? null;
    }
}