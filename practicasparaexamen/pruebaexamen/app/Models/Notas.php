<?php
namespace App\Models;
require_once('DBAbstractModel.php');

class Notas extends DBAbstractModel
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
    private $id_usuario;
    private $id_examen;
    private $nota;
    private $fecha_realizacion;

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function setIdExamen($id_examen)
    {
        $this->id_examen = $id_examen;
    }

    public function setNota($nota)
    {
        $this->nota = $nota;
    }

    public function setFechaRealizacion($fecha_realizacion)
    {
        $this->fecha_realizacion = $fecha_realizacion;
    }

    public function getIdUsario()
    {
        return $this->id_usuario;
    }

    public function getIdExamen()
    {
        return $this->id_examen;
    }

    public function getNota()
    {
        return $this->nota;
    }

    public function getFechaRealizacion()
    {
        return $this->fecha_realizacion;
    }

    public function get($id = '')
    {
        if ($id != '') {
            $this->query = "SELECT * FROM notas WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
        }
        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad => $valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Nota encontrada';
        } else {
            $this->mensaje = 'Nota no encontrada';
        }
    }

    public function set()
    {
        $fecha = new \Datetime();
        $this->query = "INSERT INTO notas(id_usuario, id_examen, nota, fecha_realizacion) VALUES(:id_usuario, :id_examen, :nota, :fecha_realizacion)";
        $this->parametros['id_usuario'] = $this->id_usuario;
        $this->parametros['id_examen'] = $this->id_examen;
        $this->parametros['nota'] = $this->nota;
        $this->parametros['fecha_realizacion'] = $fecha->format('Y-m-d H:i:s');

        $this->get_results_from_query();
        $this->mensaje = 'Nota añadida.';
    }

    public function edit()
    {
        $this->query = "UPDATE notas SET id_usuario=:id_usuario, id_examen=:id_examen, nota=:nota, fecha_realizacion=:fecha_realizacion WHERE id=:id";
        $this->parametros['id'] = $this->id;
        $this->parametros['id_usuario'] = $this->id_usuario;
        $this->parametros['id_examen'] = $this->id_examen;
        $this->parametros['nota'] = $this->nota;
        $this->parametros['fecha_realizacion'] = $this->fecha_realizacion;

        $this->get_results_from_query();
        $this->mensaje = 'Nota modificada.';
    }

    public function delete($id = '')
    {
        $this->query = "DELETE FROM notas WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = 'Nota eliminada.';
    }
}