<?php
// le asiganmos un espacio de nombres e importamos la clase Users con el espacio de nombres que le hemos asignado
namespace App\Controllers;
use App\Model\Users;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $usuario = Users::getInstancia();

        // Si se ha enviado el formulario de búsqueda
        if (isset($_GET['nombre'])) {
            $buscador = $_GET['nombre'];
            if ($buscador == "") {
                $data['usuarios'] = $usuario->getAll();
            } else {
                $data['usuarios'] = $usuario->getUsuarioNombre($buscador);
            }
        } else {
            $data['usuarios'] = $usuario->getAll();
        }

        // Pasamos los resultados a la vista
        if (empty($data['usuarios'])) {
            $data['error'] = 'No hay ningun usuario con ese nombre';
        }

        $this->renderHTML('../app/views/index_view.php', $data);
    }

    public function verPerfilAction()
{
    $id = explode('/', $_SERVER['REQUEST_URI'])[2];
    $usuario = Users::getInstancia()->get($id);

    // Verificamos si se encontraron los datos del usuario
    if ($usuario && $usuario['visible'] == 1) {
        $data['nombre'] = $usuario['nombre'];
        $data['apellidos'] = $usuario['apellidos'];
        $data['email'] = $usuario['email'];
        $data['categoria_profesional'] = $usuario['categoria_profesional'];
        $data['resumen_perfil'] = $usuario['resumen_perfil'];
        $data['foto'] = '/upload/' . $usuario['foto'];

        // Datos de skills
        $data['habilidades'] = [];
        $data['categoria'] = [];
        if ($usuario['skills']) {
            foreach ($usuario['skills'] as $skill) {
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
        if ($usuario['trabajos']) {
            foreach ($usuario['trabajos'] as $trabajo) {
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
        if ($usuario['redes']) {
            foreach ($usuario['redes'] as $red) {
                $data['redessociales'][] = $red['redes_socialescol'];
                $data['redessocialesurl'][] = $red['url'];
            }
        }

        // Datos de proyectos
        $data['proyectos'] = [];
        if ($usuario['proyectos']) {
            foreach ($usuario['proyectos'] as $proyecto) {
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