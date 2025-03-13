<?php
namespace App\Controllers;

class NumerosController extends BaseController {

    public function paresAction() {
        $pares = [];
        $numero = 2;

        while (count($pares) < 10) {
            $pares[] = $numero;
            $numero += 2; // Incrementar de dos en dos para obtener números pares
        }

        // Cambiar 'message' a 'pares' para que coincida con la vista
        $data = array('pares' => $pares);
        $this->renderHTML('../app/views/par_view.php', $data);
    }
}
?>
