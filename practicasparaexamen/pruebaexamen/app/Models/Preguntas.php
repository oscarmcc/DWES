<?php

namespace App\Models;
use App\Models\Examenes;

class Preguntas extends DBAbstractModel
{
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
    private $id_examen;
    private $enunciado;
    private $opcion_a;
    private $opcion_b;
    private $opcion_c;
    private $opcion_d;
    private $respuesta_correcta;

    public function setIdExamen($id_examen)
    {
        $this->id_examen = $id_examen;
    }

    public function setEnunciado($enunciado)
    {
        $this->enunciado = $enunciado;
    }

    public function setOpcionA($opcion_a)
    {
        $this->opcion_a = $opcion_a;
    }

    public function setOpcionB($opcion_b)
    {
        $this->opcion_b = $opcion_b;
    }

    public function setOpcionC($opcion_c)
    {
        $this->opcion_c = $opcion_c;
    }

    public function setOpcionD($opcion_d)
    {
        $this->opcion_d = $opcion_d;
    }

    public function setRespuestaCorrecta($respuesta_correcta)
    {
        $this->respuesta_correcta = $respuesta_correcta;
    }

    public function getIdExamen()
    {
        return $this->id_examen;
    }

    public function getEnunciado()
    {
        return $this->enunciado;
    }

    public function getOpcionA()
    {
        return $this->opcion_a;
    }

    public function getOpcionB()
    {
        return $this->opcion_b;
    }

    public function getOpcionC()
    {
        return $this->opcion_c;
    }

    public function getOpcionD()
    {
        return $this->opcion_d;
    }

    public function getRespuestaCorrecta()
    {
        return $this->respuesta_correcta;
    }

    public function get()
    {
    }

    public function getByExamen($id_examen)
    {
        $this->query = "SELECT * FROM preguntas WHERE id_examen = :id_examen";
        $this->parametros['id_examen'] = $id_examen;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getRespuestasCorrectasByExamen($id_examen)
    {
        $this->query = "SELECT respuesta_correcta FROM preguntas WHERE id_examen = :id_examen";
        $this->parametros['id_examen'] = $id_examen;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function set(){}

    public function edit(){}

    public function delete(){}

}