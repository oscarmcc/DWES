<?php
/**
 * 
 * 
 */
require_once "Persona.php";

class Alumno extends Persona
{
    private $_nie;

    public function Saludo(){
        echo parent::Saludo();
        echo " Soy un alumno";
    }
}

?>