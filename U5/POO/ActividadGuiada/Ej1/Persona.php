<?php
/**
 * 
 * @author Óscar
 */

 // Clase persona
class Persona
{
    private $_nombre;
    private $_apellido1;
    private $_apellido2;

    public function __construct($nombre, $apellido1, $apellido2)
    {
        $this->_nombre = $nombre; // $this- seudo variable que referencia al objeto
        $this->_apellido1 = $apellido1;
        $this->_apellido2 = $apellido2;
    }

    /**
     * Función que devuelve el nombre completo
     * 
     * @return string
     */
    public function nombre()
    {
        return $this->_nombre . " " . $this->_apellido1 . " " . $this->_apellido2;
    }

    /**
     * Función que devuelve Hola mundo
     * @return void
     */
    public function Saludo(){
        echo "Hola mundo";
    }

}

?>