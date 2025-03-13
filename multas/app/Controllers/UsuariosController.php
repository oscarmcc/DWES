<?php
namespace App\Controllers;

use App\Models\Usuarios;
use App\Models\Multas;

class UsuariosController extends BaseController
{

    public function verMultasAction(){
        $data['multas'] = '';

        $multas = Multas::getInstancia();
        $data['multas'] = $multas->getByUsuario($_SESSION['id']);

        $this->renderHTML('../app/views/perfil_conductor_view.php', $data);
    }

    public function verMultasAgenteAction(){
        $data['multas'] = '';

        $multas = Multas::getInstancia();
        $usuarios = Usuarios::getInstancia();
        $data['usuario'] = $usuarios->get($_SESSION['id']);

        $data['multas'] = $multas->getByAgente($_SESSION['id']);

        $data['nombre'] = $data['usuario'][0]['nombre'];
        
        $this->renderHTML('../app/views/perfil_agente_view.php', $data);
    }

    public function logoutAction(){
        session_destroy();
        header('Location: /');
    }
}