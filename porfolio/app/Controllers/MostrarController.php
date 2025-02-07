<?php
// le asiganmos un espacio de nombres e importamos la clase Users con el espacio de nombres que le hemos asignado
namespace App\Controllers;
use App\Model\Users;
use App\Model\Proyectos;
use App\Model\Trabajos;
use App\Model\Redes;
use App\Model\Skills;

class MostrarController extends BaseController
{
    public function indexAction()
    {
        $usuario1 = Users::getInstancia();

        // Comprobamos si la sesión está iniciada
        if (strlen($_SESSION['id']) == 0) {
            ?>
            <button><a href="/registro/">Registrarse</a></button>
            <button><a href="/login/">Login</a></button>
            <?php
        } else {
            ?>
            <button><a href="/logout/">Logout</a></button>
            <button><a href="/perfil/">Mi Perfil</a></button>
            <?php
        }

        // Si se ha enviado el formulario de búsqueda
        if (isset($_POST['buscar'])) {
            $buscador = $_POST['buscador'];
            if ($buscador == "") {
                $resultado = $usuario1->getAll();
            } else {
                $resultado = $usuario1->getUsuarioNombre($buscador);
            }
        } else {
            $resultado = $usuario1->getAll();
        }

        // Pasamos los resultados a la vista
        if ($resultado) {
            $data['usuarios'] = $resultado;
        } else {
            $data['error'] = 'No hay ningun usuario con ese nombre';
        }

        $this->renderHTML('../app/views/index_view.php', $data);
    }

    public function perfilAction()
    {

        if(strlen($_SESSION['id']) == 0){
            header('Location: /');
            exit();
        }
        $data = [];
        // 4data para usuarios
        $data['nombre'] = $data['apellidos'] = $data['email'] = $data['categoria_profesional'] = $data['resumen_perfil'] = $data['foto'] = '';

        //data para skills
        $data['skills'] = "";
        $data['habilidades'] = [];
        $data['categoria'] = [];
        $data['visibleskills'] = [];
        $data['idskills'] = [];

        //data para trabajos
        $data['trabajos']='';
        $data['idtrabajos']=$data['titulotrabajo'] = $data['descripciontrabajo'] = $data['fecha_iniciotrabajo'] = $data['fecha_finaltrabajo'] = $data['logros'] = $data['visibletrabajos']= [];

        //data para redes
        $data['redes']='';
        $data['redessociales'] =$data['redessocialesurl'] = [];
        $data['idredes'] = [];

        // data para proyectos
        $data['proyectos'] = '';
        $data['tecnologias']=[];
        $data['titulo'] = $data['descripcion']= $data['visibleproyectos'] = $data['idproyectos'] = [];

        // Instanciamos los objetos
        $usuario1 = Users::getInstancia();
        $skills = Skills::getInstancia();
        $trabajos = Trabajos::getInstancia();
        $redes = Redes::getInstancia();
        $proyectos = Proyectos::getInstancia();

        // Obtenemos los datos
        $resultado = $usuario1->getUsuarioById($_SESSION['id']);
        $data['skills'] = $skills->getSkillsByUsuarioId($_SESSION['id']);
        $data['trabajos'] = $trabajos->getTrabajaosByUsuarioId($_SESSION['id']);
        $data['redes'] = $redes->getRedesByUsuarioId($_SESSION['id']);
        $data['proyectos'] = $proyectos->getProyectosByUsuarioId($_SESSION['id']);

        // Insertamos los datos en los arrays
        if($data['redes']){
            foreach($data['redes'] as $red){
                array_push($data['redessociales'],$red['redes_socialescol']);
                array_push($data['redessocialesurl'],$red['url']);
                array_push($data['idredes'],$red['id']);
            }
        }
        if($data['trabajos']){
            foreach($data['trabajos'] as $trabajo){
                array_push($data['titulotrabajo'],$trabajo['titulo']);
                array_push($data['descripciontrabajo'],$trabajo['descripcion']);
                array_push($data['fecha_iniciotrabajo'],$trabajo['fecha_inicio']);
                array_push($data['fecha_finaltrabajo'],$trabajo['fecha_final']);
                array_push($data['logros'],$trabajo['logros']);
                array_push($data['visibletrabajos'],$trabajo['visible']);
                array_push($data['idtrabajos'],$trabajo['id']);
        }}

        // var_dump($skills);
        if($data['skills']){
            foreach($data['skills'] as $skill){
                array_push($data['habilidades'],$skill['habilidades']);
                array_push($data['categoria'],$skill['categorias_skill_categoria']);
                array_push($data['visibleskills'],$skill['visible']);
                array_push($data['idskills'],$skill['id']);
            }
        }

        if($data['proyectos']){
            foreach($data['proyectos'] as $proyecto){
                array_push($data['tecnologias'],$proyecto['tecnologias']);
                array_push($data['titulo'],$proyecto['titulo']);
                array_push($data['descripcion'],$proyecto['descripcion']);
                array_push($data['visibleproyectos'],$proyecto['visible']);
                array_push($data['idproyectos'],$proyecto['id']);
            }
        }
        if ($resultado['visible'] == 0) {
            $data['botonvisibilizar'] = '<li><a href="/visible/">Visibilizar</a></li>';
        } else {
            $data['botonvisibilizar'] = '<li><a href="/novisible/">No Visibilizar</a></li>';
        }
        // var_dump($resultado);
        if($resultado){
            $data['nombre'] = $resultado['nombre'];
            $data['apellidos'] = $resultado['apellidos'];
            $data['email'] = $resultado['email'];
            $data['categoria_profesional'] = $resultado['categoria_profesional'];
            $data['resumen_perfil'] = $resultado['resumen_perfil'];
            $data['foto'] =$resultado['foto'];
        }else{
            $data['error'] = 'No se ha encontrado el usuario';
        }
        $this->renderHTML('../app/views/miperfil_view.php', $data);
    }

    public function verPerfilAction(){

        // Comprobamos si la sesión está iniciada
        if (strlen($_SESSION['id']) == 0) {
            $data['nav'] = "
            <li><a href=\"/registro/\">Registrarse</a></li>
            <li><a href=\"/login/\">Login</a></li>
            ";
        } else {
            $data['nav'] = "
            <li><a href=\"/logout/\">Logout</a></li>
            <li><a href=\"/perfil/\">Mi Perfil</a></li>
            ";
        }
        $id = explode('/', $_SERVER['REQUEST_URI'])[2];
        $data['usuario'] = Users::getInstancia()->getUsuarioById($id);
        $data['skills'] = Skills::getInstancia()->getSkillsByUsuarioId($id);
        $data['trabajos'] = Trabajos::getInstancia()->getTrabajaosByUsuarioId($id);
        $data['redes'] = Redes::getInstancia()->getRedesByUsuarioId($id);
        $data['proyectos'] = Proyectos::getInstancia()->getProyectosByUsuarioId($id);

        if($data['usuario'] && $data['usuario']['visible'] == 1){
            $data['nombre'] = $data['usuario']['nombre'];
            $data['apellidos'] = $data['usuario']['apellidos'];
            $data['email'] = $data['usuario']['email'];
            $data['categoria_profesional'] = $data['usuario']['categoria_profesional'];
            $data['resumen_perfil'] = $data['usuario']['resumen_perfil'];
            $data['foto'] = '/upload/' . $data['usuario']['foto'];
        }

        if($data['skills']){
            foreach($data['skills'] as $skill){
                if($skill['visible'] == 1){
                    $data['habilidades'][] = $skill['habilidades'];
                    $data['categoria'][] = $skill['categorias_skill_categoria'];
                }
            }
        }

        if($data['trabajos']){
            foreach($data['trabajos'] as $trabajo){
                if($trabajo['visible'] == 1){
                    $data['titulotrabajo'][] = $trabajo['titulo'];
                    $data['descripciontrabajo'][] = $trabajo['descripcion'];
                    $data['fecha_iniciotrabajo'][] = $trabajo['fecha_inicio'];
                    $data['fecha_finaltrabajo'][] = $trabajo['fecha_final'];
                    $data['logros'][] = $trabajo['logros'];
                }
            }
        }

        if($data['redes']){
            foreach($data['redes'] as $red){
                $data['redessociales'][] = $red['redes_socialescol'];
                $data['redessocialesurl'][] = $red['url'];
            }
        }

        if($data['proyectos']){
            foreach($data['proyectos'] as $proyecto){
                if($proyecto['visible'] == 1){
                    $data['tecnologias'][] = $proyecto['tecnologias'];
                    $data['titulo'][] = $proyecto['titulo'];
                    $data['descripcion'][] = $proyecto['descripcion'];
                }
            }
        }

        $this->renderHTML('../app/views/verperfil_view.php', $data);
    }
}



?>