<?php
/**
 * 
 * 
 */

 class Contador
 {
    private $contador; // Variable privada
    static $instancia = 0; // Variable de instancia
 
    /**
     * Creacion del constructor
     * @param mixed $cont
     */
    public function __construct($cont = 0){
        $this->contador = $cont;
        self::$instancia ++;
    }

    /**
     * Creación de la función para incrementar el contador
     * @return static
     */
    public function contar(){
        $this->contador ++;
        return $this;
    }

    /**
     * Creación función para ver cuantas instancias se han creado
     * @return mixed
     */
    public static function ninstancias(){
        return self::$instancia;
    }


    /**
     * Summary of __tostring
     * @return string
     */
    public function __tostring(){
        return (string) $this->contador;
    }
 }