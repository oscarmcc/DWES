<?php
namespace App\Models;
require_once('DBAbstractModel.php');

class Pizzas extends DBAbstractModel
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
     private $cliente_id;
        private $nombre;
        private $descripcion;
        private $ingredientes;
     private $foto;

        public function setId($id)
        {
            $this->id = $id;
        }

        public function setIdCliente($cliente_id)
        {
            $this->cliente_id = $cliente_id;
        }

        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }

        public function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;
        }

        public function setIngredientes($ingredientes)
        {
            $this->ingredientes = $ingredientes;
        }

        public function setFoto($foto)
        {
            $this->foto = $foto;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getIdCliente()
        {
            return $this->cliente_id;
        }

        public function getNombre()
        {
            return $this->nombre;
        }

        public function getDescripcion()
        {
            return $this->descripcion;
        }

        public function getIngredientes()
        {
            return $this->ingredientes;
        }

        public function getFoto()
        {
            return $this->foto;
        }


        public function get($id = '')
        {
            if($id != ''){
                $this->query = "SELECT id, cliente_id, nombre, descripcion, ingredientes, foto FROM pizzas WHERE id = :id";
                $this->parametros['id'] = $id;
                $this->get_results_from_query();
            }
            if (count($this->rows) == 1) {
                $this->mensaje = 'Usuario encontrado';
            } else {
                $this->mensaje = 'Usuario no encontrado';
            }
    
            return $this->rows;
        }

        public function set(){
            $this->query = "INSERT INTO pizzas (cliente_id, nombre, descripcion, ingredientes, foto) VALUES (:cliente_id, :nombre, :descripcion, :ingredientes, :foto)";
            $this->parametros['cliente_id'] = $this->cliente_id;
            $this->parametros['nombre'] = $this->nombre;
            $this->parametros['descripcion'] = $this->descripcion;
            $this->parametros['ingredientes'] = $this->ingredientes;
            $this->parametros['foto'] = $this->foto;
            $this->get_results_from_query();
            $this->mensaje = 'Pizza agregada';
        }

        public function getPizzasNombreByCliente($cliente_id = '')
        {
            $this->query = "SELECT nombre FROM pizzas WHERE cliente_id = :cliente_id";
            $this->parametros['cliente_id'] = $cliente_id;
            $this->get_results_from_query();
            return $this->rows;
        }

        public function getPizzasByNombre($nombre = '')
        {
            $this->query = "SELECT id, cliente_id, nombre, descripcion, ingredientes, foto FROM pizzas WHERE nombre = :nombre";
            $this->parametros['nombre'] = $nombre;
            $this->get_results_from_query();
            return $this->rows;
        }

        public function getAll()
        {
            $this->query = "SELECT id, cliente_id, nombre, descripcion, ingredientes, foto FROM pizzas";
            $this->get_results_from_query();
            return $this->rows;
        }

        public function delete($id = '')
        {
            if ($id != '') {
                $this->query = "DELETE FROM pizzas WHERE id = :id";
                $this->parametros['id'] = $id;
                $this->get_results_from_query();
                $this->mensaje = 'Pizza eliminada';
            }
        }

        public function edit()
        {
            $this->query = "UPDATE pizzas SET cliente_id = :cliente_id, nombre = :nombre, descripcion = :descripcion, ingredientes = :ingredientes, foto = :foto WHERE id = :id";
            $this->parametros['id'] = $this->id;
            $this->parametros['cliente_id'] = $this->cliente_id;
            $this->parametros['nombre'] = $this->nombre;
            $this->parametros['descripcion'] = $this->descripcion;
            $this->parametros['ingredientes'] = $this->ingredientes;
            $this->parametros['foto'] = $this->foto;
            $this->get_results_from_query();
            $this->mensaje = 'Pizza modificada';
        }


}
?>