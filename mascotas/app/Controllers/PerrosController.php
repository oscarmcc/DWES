<?php
namespace App\Controllers;
use App\Models\Mascotas;
class PerrosController extends BaseController
{
    public function indexAction($request)
    {
        $this->renderHTML('perros/index.html');
    }
}


?>