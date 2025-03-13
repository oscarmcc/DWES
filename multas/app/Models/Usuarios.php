<?php
namespace App\Models;

require_once ('DBAbstractModel.php');

class Usuarios extends DBAbstractModel
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
    private $usuario;
    private $password;
    private $nombre;
    private $perfil;

    // Creacion de los seter de las variables
    public function setId($id){
        $this->id = $id;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setPerfil($perfil){
        $this->perfil = $perfil;
    }

    // Creacion de getters
    public function getId(){
        return $this->id;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getPerfil(){
        return $this->perfil;
    }

    public function set(){
    }


    public function get($id=''){
        $this->query = "SELECT * FROM usuarios WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function edit(){}
    public function delete(){}

    public function getAll(){
        $this->query = "SELECT * FROM usuarios";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getConductores(){
        $this->query = "SELECT * FROM usuarios WHERE perfil = :perfil";
        $this->parametros['perfil'] = 'conductor';
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getByUsuario($usuario=''){
        $this->query = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $this->parametros['usuario'] = $usuario;
        $this->get_results_from_query();
        return $this->rows[0];
    }
}