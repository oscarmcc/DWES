<?php
namespace App\Controllers;
use App\Models\Blog;
use App\Models\Comment;

class DatosCargadosController extends BaseController
{
    public function cargarDatos($ablogs)
    {
        require_once '../datos/datos.php';
        $data = [];
        foreach ($ablogs as $blog){
            $blog->set();
        }
        $data['mensaje'] = 'Datos cargados correctamente';
        $this->renderHTML('../app/views/proceso_terminado_view.php', $data);
    }
}
?>