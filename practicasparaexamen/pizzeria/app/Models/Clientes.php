<?php
namespace App\Models;

require_once('DBAbstractModel.php');


class Clientes extends DBAbstractModel
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
        private $nombre;
        private $apellidos;
        private $email;
        private $password;
        private $foto;
        private $created_at;
        private $updated_at;

        public function setId($id)
        {
            $this->id = $id;
        }

        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }

        public function setApellidos($apellidos)
        {
            $this->apellidos = $apellidos;
        }

        public function setEmail($email)
        {
            $this->email = $email;
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }

        public function setFoto($foto)
        {
            $this->foto = $foto;
        }

        public function setCreatedAt($created_at)
        {
            $this->created_at = $created_at;
        }

        public function setUpdatedAt($updated_at)
        {
            $this->updated_at = $updated_at;
        }

        public function getID()
        {
            return $this->id;
        }

        public function getNombre()
        {
            return $this->nombre;
        }

        public function getApellidos()
        {
            return $this->apellidos;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function getFoto()
        {
            return $this->foto;
        }

        public function getCreatedAt()
        {
            return $this->created_at;
        }

        public function getUpdatedAt()
        {
            return $this->updated_at;
        }

        public function addPizzas($pizza)
        {
            $this->pizzas[] = $pizza;
        }

        public function get($id = '')
        {
            if ($id != '') {
                $this->query = "SELECT id, nombre, apellidos, email, foto, created_at, updated_at FROM clientes WHERE id = :id";
                $this->parametros['id'] = $id;
                $this->get_results_from_query();
            }
            if (count($this->rows) == 1) {
                foreach ($this->rows[0] as $propiedad => $valor) {
                    $this->$propiedad = $valor;
                }
                $this->mensaje = 'Cliente encontrado';
            } else {
                $this->mensaje = 'Cliente no encontrado';
            }
        }

        public function getbyEmail($email = '')
        {
            $this->query = "SELECT * FROM clientes WHERE email = :email";
            $this->parametros['email'] = $email;
            $this->get_results_from_query();
            if (count($this->rows) == 1) {
                $this->mensaje = 'Cliente encontrado';
                return $this->rows[0];
            } else {
                $this->mensaje = 'Cliente no encontrado';
                return false;
            }
        }

        public function getAll()
        {
            $this->query = "SELECT id, nombre, apellidos, email, foto, created_at, updated_at FROM clientes";
            $this->get_results_from_query();
            return $this->rows;
        }

        public function set()
        {
            $fecha = new \DateTime();
            $this->query = "INSERT INTO clientes(nombre, apellidos, email, password, foto, created_at) VALUES(:nombre, :apellidos, :email, :password, :foto, :created_at)";

            $this->parametros['nombre'] = $this->nombre;
            $this->parametros['apellidos'] = $this->apellidos;
            $this->parametros['email'] = $this->email;
            $this->parametros['password'] = $this->password;
            $this->parametros['foto'] = $this->foto;
            $this->parametros['created_at'] = $fecha->format('Y-m-d H:i:s');
        
        try{
            $this->get_results_from_query();
            $idCliente = $this->lastInsert();

            foreach($this->pizzas as $pizza){
                $this->query = "INSERT INTO pizzas(cliente_id,nombre, descpricion, ingredientes,foto) VALUES(:cliente_id, :nombre, :descripcion,:ingredientes,:foto)";
                $this->parametros['cliente_id'] = $idCliente;
                $this->parametros['nombre'] = $pizza->getNombre();
                $this->parametros['descripcion'] = $pizza->getDescripcion();
                $this->parametros['foto'] = $pizza->getFoto();
                $this->parametros['ingredientes'] = $pizza->getIngredientes();
                $this->get_results_from_query();
            }
            $this->mensaje = 'Cliente añadido';
        } catch (Exception $e) {
            $this->mensaje = 'Error al añadir cliente';
        }
        
        }

        public function edit()
        {
            $fecha = new \DateTime();
            $this->query = "UPDATE clientes SET nombre = :nombre, apellidos = :apellidos, email = :email, foto = :foto, updated_at = :updated_at WHERE id = :id";
            $this->parametros['nombre'] = $this->nombre;
            $this->parametros['apellidos'] = $this->apellidos;
            $this->parametros['email'] = $this->email;
            $this->parametros['foto'] = $this->foto;
            $this->parametros['updated_at'] = $fecha->format('Y-m-d H:i:s');
            $this->parametros['id'] = $this->id;
            $this->get_results_from_query();
            $this->mensaje = 'Cliente modificado';
        }

        public function delete($id = '')
        {
            $this->query = "DELETE FROM clientes WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
            $this->mensaje = 'Cliente eliminado';
        }


}
?>