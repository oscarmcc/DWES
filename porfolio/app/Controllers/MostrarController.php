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
        if (isset($_GET['nombre'])) {
            $buscador = $_GET['nombre'];
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
    if (strlen($_SESSION['id']) == 0) {
        header('Location: /');
        exit();
    }

    $data = [];
    $usuario1 = Users::getInstancia();

    // Obtenemos los datos del usuario y sus relaciones
    $resultado = $usuario1->get($_SESSION['id']);

    // Verificamos si se encontraron los datos del usuario
    if ($resultado) {
        $data['nombre'] = $resultado['nombre'];
        $data['apellidos'] = $resultado['apellidos'];
        $data['email'] = $resultado['email'];
        $data['categoria_profesional'] = $resultado['categoria_profesional'];
        $data['resumen_perfil'] = $resultado['resumen_perfil'];
        $data['foto'] = $resultado['foto'];

        // Datos de skills
        $data['habilidades'] = [];
        $data['categoria'] = [];
        $data['visibleskills'] = [];
        $data['idskills'] = [];
        if ($resultado['skills']) {
            foreach ($resultado['skills'] as $skill) {
                $data['habilidades'][] = $skill['habilidades'];
                $data['categoria'][] = $skill['categorias_skill_categoria'];
                $data['visibleskills'][] = $skill['visible'];
                $data['idskills'][] = $skill['id'];
            }
        }

        // Datos de trabajos
        $data['titulotrabajo'] = [];
        $data['descripciontrabajo'] = [];
        $data['fecha_iniciotrabajo'] = [];
        $data['fecha_finaltrabajo'] = [];
        $data['logros'] = [];
        $data['visibletrabajos'] = [];
        $data['idtrabajos'] = [];
        if ($resultado['trabajos']) {
            foreach ($resultado['trabajos'] as $trabajo) {
                $data['titulotrabajo'][] = $trabajo['titulo'];
                $data['descripciontrabajo'][] = $trabajo['descripcion'];
                $data['fecha_iniciotrabajo'][] = $trabajo['fecha_inicio'];
                $data['fecha_finaltrabajo'][] = $trabajo['fecha_final'];
                $data['logros'][] = $trabajo['logros'];
                $data['visibletrabajos'][] = $trabajo['visible'];
                $data['idtrabajos'][] = $trabajo['id'];
            }
        }

        // Datos de redes sociales
        $data['redessociales'] = [];
        $data['redessocialesurl'] = [];
        $data['idredes'] = [];
        if ($resultado['redes']) {
            foreach ($resultado['redes'] as $red) {
                $data['redessociales'][] = $red['redes_socialescol'];
                $data['redessocialesurl'][] = $red['url'];
                $data['idredes'][] = $red['id'];
            }
        }

        // Datos de proyectos
        $data['proyectos'] = [];
        if ($resultado['proyectos']) {
            foreach ($resultado['proyectos'] as $proyecto) {
                $data['proyectos'][] = [
                    'tecnologias' => $proyecto['tecnologias'],
                    'titulo' => $proyecto['titulo'],
                    'descripcion' => $proyecto['descripcion'],
                    'visible' => $proyecto['visible'],
                    'id' => $proyecto['id']
                ];
            }
        }

        // Botón de visibilidad
        if ($resultado['visible'] == 0) {
            $data['botonvisibilizar'] = '<li><a href="/visible/">Visibilizar</a></li>';
        } else {
            $data['botonvisibilizar'] = '<li><a href="/novisible/">No Visibilizar</a></li>';
        }
    } else {
        $data['error'] = 'No se ha encontrado el usuario';
    }

    $this->renderHTML('../app/views/miperfil_view.php', $data);
}

    public function verPerfilAction()
    {
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
        $usuario1 = Users::getInstancia();
    
        // Obtenemos los datos del usuario y sus relaciones
        $resultado = $usuario1->get($id);
    
        // Verificamos si se encontraron los datos del usuario
        if ($resultado && $resultado['visible'] == 1) {
            $data['nombre'] = $resultado['nombre'];
            $data['apellidos'] = $resultado['apellidos'];
            $data['email'] = $resultado['email'];
            $data['categoria_profesional'] = $resultado['categoria_profesional'];
            $data['resumen_perfil'] = $resultado['resumen_perfil'];
            $data['foto'] = '/upload/' . $resultado['foto'];
    
            // Datos de skills
            $data['habilidades'] = [];
            $data['categoria'] = [];
            if ($resultado['skills']) {
                foreach ($resultado['skills'] as $skill) {
                    if ($skill['visible'] == 1) {
                        $data['habilidades'][] = $skill['habilidades'];
                        $data['categoria'][] = $skill['categorias_skill_categoria'];
                    }
                }
            }
    
            // Datos de trabajos
            $data['titulotrabajo'] = [];
            $data['descripciontrabajo'] = [];
            $data['fecha_iniciotrabajo'] = [];
            $data['fecha_finaltrabajo'] = [];
            $data['logros'] = [];
            if ($resultado['trabajos']) {
                foreach ($resultado['trabajos'] as $trabajo) {
                    if ($trabajo['visible'] == 1) {
                        $data['titulotrabajo'][] = $trabajo['titulo'];
                        $data['descripciontrabajo'][] = $trabajo['descripcion'];
                        $data['fecha_iniciotrabajo'][] = $trabajo['fecha_inicio'];
                        $data['fecha_finaltrabajo'][] = $trabajo['fecha_final'];
                        $data['logros'][] = $trabajo['logros'];
                    }
                }
            }
    
            // Datos de redes sociales
            $data['redessociales'] = [];
            $data['redessocialesurl'] = [];
            if ($resultado['redes']) {
                foreach ($resultado['redes'] as $red) {
                    $data['redessociales'][] = $red['redes_socialescol'];
                    $data['redessocialesurl'][] = $red['url'];
                }
            }
    
            // Datos de proyectos
            $data['proyectos'] = [];
            if ($resultado['proyectos']) {
                foreach ($resultado['proyectos'] as $proyecto) {
                    if ($proyecto['visible'] == 1) {
                        $data['proyectos'][] = [
                            'tecnologias' => $proyecto['tecnologias'],
                            'titulo' => $proyecto['titulo'],
                            'descripcion' => $proyecto['descripcion']
                        ];
                    }
                }
            }
        } else {
            $data['error'] = 'No se ha encontrado el usuario o el perfil no es visible';
        }
    
        $this->renderHTML('../app/views/verperfil_view.php', $data);
    }
}



?>