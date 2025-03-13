<?php
namespace App\Models;
require_once ('DBAbstractModel.php');

class TiposSanciones extends DBAbstractModel
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

        /*ATRIBUTOS DE LA CLASE*/
        private $id;
        private $tipo;
        private $importe;
        private $puntos;

        /*MÉTODOS DE LA CLASE*/
        public function setId($id)
        {
            $this->id = $id;
        }
        public function getId()
        {
            return $this->id;
        }
        public function setTipo($tipo)
        {
            $this->tipo = $tipo;
        }
        public function getTipo()
        {
            return $this->tipo;
        }

        public function setImporte($importe)
        {
            $this->importe = $importe;
        }

        public function getImporte()
        {
            return $this->importe;
        }

        public function setPuntos($puntos)
        {
            $this->puntos = $puntos;
        }

        public function getPuntos()
        {
            return $this->puntos;
        }

        public function get($id=''){
            $this->query = "SELECT * FROM tipos_sanciones WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
            return $this->rows;
        }


        public function set(){
            $this->query = "INSERT INTO tipos_sanciones (tipo, importe, puntos) VALUES (:tipo, :importe, :puntos)";
            $this->parametros['tipo'] = $this->tipo;
            $this->parametros['importe'] = $this->importe;
            $this->parametros['puntos'] = $this->puntos;
            $this->get_results_from_query();
            return $this->rows;
        }

        public function edit(){
            $this->query = "UPDATE tipos_sanciones SET tipo = :tipo, importe = :importe, puntos = :puntos WHERE id = :id";
            $this->parametros['id'] = $this->id;
            $this->parametros['tipo'] = $this->tipo;
            $this->parametros['importe'] = $this->importe;
            $this->parametros['puntos'] = $this->puntos;
            $this->get_results_from_query();
            return $this->rows;
        }

        public function delete($id=''){
            $this->query = "DELETE FROM tipos_sanciones WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
            return $this->rows;
        }
}