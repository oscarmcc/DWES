<?php
namespace App\Controllers;
use App\Models\Usuarios;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $usuarioModel = Usuarios::getInstancia();
        $data['usuarios'] = [];

        $usuarios = $usuarioModel->getAll();
        
        foreach ($usuarios as &$usuario) {
            $usuario['notas']=$usuarioModel->getNotas($usuario['id']);
            // var_dump($usuario['notas']);
        }

        // var_dump($usuarios);

        $data['usuarios'] = $usuarios;

        if(empty($data['usuarios'])){
            $data['error'] = 'No hay usuarios registrados';
        }


        $this->renderHTML('../app/views/index_view.php', $data);
    }
}