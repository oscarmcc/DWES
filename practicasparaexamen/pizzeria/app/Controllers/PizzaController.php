<?php

namespace App\Controllers;

use App\Models\Clientes;
use App\Models\Pizzas;

class PizzaController extends BaseController
{
    public function verPizzasAction()
    {
        $pizzas = Pizzas::getInstancia();
        $data['pizzas'] = '';

        $data['pizzasNombre'] = $pizzas->getPizzasNombreByCliente($_SESSION['id']);

        var_dump($data['pizzasNombre']);

        if(isset($_POST['verpizza']))
        {
            $nombre= $_POST['nombre'];
            $data['pizzas'] = $pizzas->getPizzasByNombre($nombre);
        }


        $this->renderHTML('../app/views/pizza_view.php', $data);
        
    }
}

?>