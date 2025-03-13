<?php
namespace App\Model;
require_once('DBAbstractModel.php');

use App\Model\Trabajos;
use App\Model\Proyectos;
use App\Model\Skills;
use App\Model\Redes;

class Users extends DBAbstractModel
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
    private $foto;
    private $categoria_profesional;
    private $email;
    private $resumen_perfil;
    private $passwd;
    private $visible;
    private $created_at;
    private $updated_at;
    private $token;
    private $fecha_creacion_token;
    private $cuenta_activa;

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }
    public function setCategoriaProfesional($categoria_profesional)
    {
        $this->categoria_profesional = $categoria_profesional;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setResumenPerfil($resumen_perfil)
    {
        $this->resumen_perfil = $resumen_perfil;
    }

    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function setFechaCreacionToken($fecha_creacion_token)
    {
        $this->fecha_creacion_token = $fecha_creacion_token;
    }

    public function setCuentaActiva($cuenta_activa)
    {
        $this->cuenta_activa = $cuenta_activa;
    }
    
    public function getMensaje(){
        return $this->mensaje;
    }

    //Función para comprobar que la cuenta del usuario esta activa o no
    public function estaActivo($email){
        $this->query = "SELECT cuenta_activa FROM usuarios WHERE email = :email";
        $this->parametros['email'] = $email;
        $this->get_results_from_query();
        if ($this->rows[0]['cuenta_activa'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarToken($token = ''){
        $this->query = "SELECT * FROM usuarios WHERE token = :token";
        $this->parametros['token'] = $token;
        $this->get_results_from_query();
        // var_dump($token);die();
        // var_dump($this->rows);die();
        if(count($this->rows) == 1){
           // Comprobar si el token ha caducado
            $this->fecha_creacion_token = $this->rows[0]['fecha_creacion_token'];
            $fecha_actual = date('Y-m-d H:i:s');
            $diferencia = strtotime($fecha_actual) - strtotime($this->fecha_creacion_token);
            if ($diferencia < 86400) {
                $this->query = "UPDATE usuarios SET token = NULL, fecha_creacion_token = NULL, visible = 1 , cuenta_activa = 1 WHERE token = :token";
                $this->parametros['token'] = $token;
                $this->get_results_from_query();
                // exit();
                $this->mensaje = 'Usuario verificado';
            } else {
                $this->mensaje = 'El token ha caducado';
            }
        } else {
            $this->mensaje = 'Token no encontrado';
            echo "no entra";
        }

        // exit();
    }

    public function getAll()
    {
        $this->query = "SELECT * FROM usuarios";
        $this->get_results_from_query();
        if (count($this->rows) > 0) {
            $this->mensaje = 'Usuarios encontrados';
            return $this->rows;
        }
        $this->mensaje = 'Usuarios no encontrados';
        return null;
    }
    public function getUsuarioEmail($email){
        $this->query = "SELECT * FROM usuarios WHERE email=:email";
        $this->parametros['email'] = $email;
        $this->get_results_from_query();
        if(count($this->rows) > 0){
            $this->mensaje = 'Usuario encontrado';
            return $this->rows;
        }
        $this->mensaje = 'Usuario no encontrado';
        return null;
    }

    public function getUsuarioById($id)
    {
        $this->query = "SELECT * FROM usuarios WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows[0] ?? null;
    }

    public function getUsuarioNombre($nombre){
        $this->query = "SELECT * FROM usuarios WHERE nombre=:nombre";
        $this->parametros['nombre'] = $nombre;
        $this->get_results_from_query();
        if(count($this->rows) > 0){
            $this->mensaje = 'Usuario encontrado';
            return $this->rows;
        }
        $this->mensaje = 'Usuario no encontrado';
        return null;
    }

    public function setVisibilidad($visible, $id){
        $this->query = "UPDATE usuarios SET visible=:visible WHERE id=:id";
        $this->parametros['id'] = $id;
        $this->parametros['visible'] = $visible;
        $this->get_results_from_query();
        $this->mensaje = 'Visibilidad modificada.';
    }
    public function set(){
        $fecha =new \Datetime();
        $this->query = "INSERT INTO usuarios(nombre, apellidos, foto, categoria_profesional, email, resumen_perfil, passwd, visible, created_at, token, fecha_creacion_token, cuenta_activa)
        VALUES(:nombre, :apellidos, :foto, :categoria_profesional, :email, :resumen_perfil, :passwd, :visible, :created_at, :token, :fecha_creacion_token, :cuenta_activa)";
        
        $this->parametros['nombre']= $this->nombre;
        $this->parametros['apellidos']= $this->apellidos;
        $this->parametros['foto']= $this->foto;
        $this->parametros['categoria_profesional']= $this->categoria_profesional;
        $this->parametros['email']= $this->email;
        $this->parametros['resumen_perfil']= $this->resumen_perfil;
        $this->parametros['passwd']= $this->passwd;
        $this->parametros['visible']= 0;
        $this->parametros['created_at'] = date('Y-m-d H:i:s', $fecha->getTimestamp());
        $this->parametros['fecha_creacion_token']= date('Y-m-d H:i:s', $fecha->getTimestamp());
        $this->parametros['cuenta_activa']= $this->cuenta_activa;
        $this->parametros['token'] = $this->token;
        $this->get_results_from_query();
        $this->mensaje = 'Usuario añadido.';
    }

    public function get($id=''){
        $this->query = "SELECT * FROM usuarios WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                // $this->$propiedad = $valor;
            }
            $this->mensaje = 'Usuario encontrada';
        } else {
            $this->mensaje = 'Usuario no encontrada';
        }
        $usuario = $this->rows[0] ?? null;

        // Obtengo los trabajos, proyectos, skills, redes sociales.
        $usuario['trabajos'] = Trabajos::getInstancia()->getTrabajaosByUsuarioId($id);
        $usuario['proyectos'] = Proyectos::getInstancia()->getProyectosByUsuarioId($id);
        $usuario['skills'] = Skills::getInstancia()->getSkillsByUsuarioId($id);
        $usuario['redes'] = Redes::getInstancia()->getRedesByUsuarioId($id);
        return $usuario ?? null;}
    
    public function edit($id=''){
        $fecha =new \Datetime();
        $this->query = "UPDATE usuarios SET nombre=:nombre, apellidos=:apellidos, foto=:foto, categoria_profesional=:categoria_profesional, email=:email, resumen_perfil=:resumen_perfil, updated_at=:updated_at, cuenta_activa=:cuenta_activa WHERE id=:id";
        $this->parametros['id'] = $id;
        $this->parametros['nombre']= $this->nombre;
        $this->parametros['apellidos']= $this->apellidos;
        $this->parametros['foto']= $this->foto;
        $this->parametros['categoria_profesional']= $this->categoria_profesional;
        $this->parametros['email']= $this->email;
        $this->parametros['resumen_perfil']= $this->resumen_perfil;
        $this->parametros['updated_at'] = date('Y-m-d H:i:s', $fecha->getTimestamp());
        $this->parametros['cuenta_activa']= 1;

        $this->get_results_from_query();
        $this->mensaje = 'Usuario modificado.';
    }

    public function delete($id=''){
        $this->query = "DELETE FROM usuarios WHERE id=:id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = 'Usuario eliminada';
    }
}