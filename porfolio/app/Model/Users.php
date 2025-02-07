<?php
namespace App\Model;
require_once('DBAbstractModel.php');

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
    public function getUsuarioEmail($email, ){
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
        $this->parametros['visible']= 1;
        $this->parametros['created_at'] = date('Y-m-d H:i:s', $fecha->getTimestamp());
        $this->parametros['fecha_creacion_token']= date('Y-m-d H:i:s', $fecha->getTimestamp());
        $this->parametros['cuenta_activa']= 1;

        $rb = random_bytes(32);
        $token  = base64_encode($rb);
        $secureToken = uniqid('',true) . $token;
        $this->parametros['token'] = $secureToken;
        $this->get_results_from_query();
        $this->mensaje = 'Usuario añadido.';
    }

    public function get($id=''){
        if($id != ''){
            $this->query = "SELECT * FROM usuarios WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
            if(count($this->rows) == 1){
                foreach ($this->rows[0] as $propiedad=>$valor){
                    $this->$propiedad = $valor;
                }
                $this->mensaje = 'Usuario encontrado';
        }else{
            $this->mensaje = 'Usuario no encontrado';
        }
        return $this->rows[0]??null;
    }}
    
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