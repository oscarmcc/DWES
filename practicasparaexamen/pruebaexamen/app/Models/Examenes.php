<?php
namespace App\Models;
require_once('DBAbstractModel.php');
use App\Models\Notas;

class Examenes extends DBAbstractModel
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
    private $id_asignatura;
    private $titulo;
    private $fecha;

    public function setIdAsignatura($id_asignatura)
    {
        $this->id_asignatura = $id_asignatura;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getIdAsignatura()
    {
        return $this->id_asignatura;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function get(){
        $this->query = "SELECT * FROM examenes";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function set(){}

    public function edit(){}

    public function delete(){}
}