<?php
namespace App\Controllers;
use App\Models\Multas;
use App\Models\Usuarios;

class MultasController extends BaseController
{

    // Funcion para pagar las multas que tenga el conductor
    public function pagarMultasAction(){
        // Obtencion del id de la multa a través de la URL
        $idMulta = explode('/', $_SERVER['REQUEST_URI'])[2];

        $data['multas']='';

        // Obtencion de la multa a través del id
        $multas = Multas::getInstancia();
        $multa = $multas->get($idMulta);

        if($multa){
            $data['multas'] = $multa;
        }

        // Si el metodo de la peticion es POST se cambia el estado de la multa a pagada

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $multas->pagarMulta($idMulta, 'Pagada');
            header('Location: /perfil/');
            exit();
        }

        $this->renderHTML('../app/views/pagar_view.php', $data);
    }


    // Funcion para añadir multas
    public function addMultasAction(){
        // Inicializacion de las variables
        $data['nombreagente'] = $data['matricula'] = $data['descripcion'] = $data['fecha'] = $data['conductor']=$data['tiposancion']='';
        $data['eNombreAgente'] = $data['eMatricula'] = $data['eDescripcion'] = $data['eFecha'] = $data['eConductor']=$data['eTipoSancion']='';


        // Obtencion del nombre del agente y de los conductores
        $usuarios = Usuarios::getInstancia();
        $usuario = $usuarios->get($_SESSION['id']);

        $data['nombreagente'] = $usuario[0]['nombre'];

        $usuarios = Usuarios::getInstancia();
        $data['conductores'] = $usuarios->getConductores();

        // Obtencion a través del formulario los datos y posteriormente comprobar si estos se encuentran vacíos para mostrar un mensaje de error

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data['matricula'] = $_POST['matricula'];
            $data['descripcion'] = $_POST['descripcion'];
            $data['fecha'] = $_POST['fecha'];
            $data['conductor'] = $_POST['conductor'];
            $data['tiposancion'] = $_POST['tipo'];

            if($data['matricula'] == ''){
                $data['eMatricula'] = 'El campo matricula es obligatorio';
            }

            if($data['descripcion'] == ''){
                $data['eDescripcion'] = 'El campo descripcion es obligatorio';
            }

            if($data['fecha'] == ''){
                $data['eFecha'] = 'El campo fecha es obligatorio';
            }

            if($data['conductor'] == ''){
                $data['eConductor'] = 'El campo conductor es obligatorio';
            }

            if($data['tiposancion'] == ''){
                $data['eTipoSancion'] = 'El campo tipo de sancion es obligatorio';
            }


            if($data['matricula'] != '' && $data['descripcion'] != '' && $data['fecha'] != '' && $data['conductor'] != '' && $data['tiposancion'] != ''){
                $multas = Multas::getInstancia();
                $multas->setIdAgente($_SESSION['id']);
                $multas->setIdConductor($data['conductor']);
                $multas->setMatricula($data['matricula']);
                $multas->setIdTipoSanciones($data['tiposancion']);
                $multas->setDescripcion($data['descripcion']);

                // Formatear la fecha para que sea compatible con la base de datos
                $data['fecha'] = date('Y-m-d', strtotime($data['fecha']));

                $multas->setFecha($data['fecha']);
                if($data['tiposancion'] == 1){
                    $multas->setImporte(100);
                }elseif($data['tiposancion'] == 2){
                    $multas->setImporte(200);
                }else{
                    $multas->setImporte(300);
                }
                $multas->setDescuento(0);

                $multas->setEstado('Pendiente');
                // var_dump($multas);die();
                $multas->set();
                header('Location: /perfilagente/');
                exit();
            }
        }
        $this->renderHTML('../app/views/add_multa_view.php', $data);
    }
}

?>