<?php
namespace App\Models;
require_once('DBAbstractModel.php');
use App\Models\Notas;

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
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $foto;
    private $visible;
    private $resumen_perfil;

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

    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    public function setResumenPerfil($resumen_perfil)
    {
        $this->resumen_perfil = $resumen_perfil;
    }

    public function addNotas($nota){
        $this->notas[] = $nota;
    }

    public function get($id = '')
    {
        if ($id != '') {
            $this->query = "SELECT id, nombre, apellidos, email, foto, visible FROM usuarios WHERE id = :id";
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

    public function getAll()
    {
        $this->query = "SELECT id, nombre, apellidos, email, foto, visible, resumen_perfil FROM usuarios";
        $this->get_results_from_query();
        return $this->rows;
    }


    public function set()
    {
        $this->query = "INSERT INTO usuarios(nombre, apellidos, email, password, foto, visible, resumen_perfil) VALUES(:nombre, :apellidos, :email, :password, :foto, :visible, :resumen_perfil)";
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['apellidos'] = $this->apellidos;
        $this->parametros['email'] = $this->email;
        $this->parametros['password'] = $this->password;
        $this->parametros['foto'] = $this->foto;
        $this->parametros['visible'] = $this->visible;
        $this->parametros['resumen_perfil'] = $this->resumen_perfil;

        try{
            $this->get_results_from_query();

            $idNota = $this->lastInsert();

            foreach($this->notas as $nota){
                $this->query = "INSERT INTO notas(nota, id_usuario, id_examen, fecha_realizacion) VALUES(:nota, :id_usuario, :id_examen, :fecha_realizacion)";
                $this->parametros['fecha_realizacion'] = $nota->getFechaRealizacion();
                $this->parametros['nota'] = $nota->getNota();
                $this->parametros['id_examen'] = $nota->getIdExamen();
                $this->parametros['id_usuario'] = $idNota;
                $this->get_results_from_query();
            }
            $this->mensaje = 'Nota añadida';
        }catch(Exception $e){
            $this->mensaje = 'Error al añadir usuario';
        }
    }

    public function getByEmail($email)
    {
        $this->query = "SELECT * FROM usuarios WHERE email = :email";
        $this->parametros['email'] = $email;
        $this->get_results_from_query();
        return $this->rows[0];
    }

    public function edit()
    {
        $this->query = "UPDATE usuarios SET nombre=:nombre, apellidos=:apellidos, email=:email,resumen_perfil=:resumen_perfil, foto=:foto WHERE id=:id";
        $this->parametros['id'] = $this->id;
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['apellidos'] = $this->apellidos;
        $this->parametros['email'] = $this->email;
        $this->parametros['foto'] = $this->foto;
        $this->parametros['resumen_perfil'] = $this->resumen_perfil;
        $this->get_results_from_query();
        $this->mensaje = 'Usuario modificado';

    }

    public function delete($id = '')
    {
        $this->query = "DELETE FROM usuarios WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = 'Usuario eliminado';
    }

    public function getNotas($id_usuario){
        $this->query = "SELECT * FROM notas WHERE id_usuario = :id_usuario";
        $this->parametros['id_usuario'] = $id_usuario;
        $this->get_results_from_query();
        return $this->rows;
    }
}
?>