<?php

namespace App\Controllers;
use App\Models\Usuarios;
use App\Models\Notas;
use App\Models\Examenes;
use App\Models\Preguntas;

class ExamenesController extends BaseController
{
    public function MostrarExamenAction()
    {

        $examenes = Examenes::getInstancia();
        $preguntas = Preguntas::getInstancia();

        $data['examenes'] = $examenes->get();
        $data['preguntas'] = '';
        $data['preguntasexamen'] = [];
        $data['respuestas_correctas'] = [];
        $data['nota'] = 0;
        $data['correcto'] = 0;
        $data['incorrecto'] = 0;

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {   
            
            $data['id_examen'] = $_POST['id_examen'];

            if(empty($data['id_examen']))
            {
                $data['eId_examen'] = 'El examen es obligatorio';
            }
            else
            {
                $data['preguntas'] = $preguntas->getByExamen($data['id_examen']);
            }
        }

        // Vamos a comprobar cuando le de al boton de enviarexamen 

        if(isset($_POST['enviarexamen'])){
            if(!empty($data['preguntasexamen'])){
                $data['preguntasexamen'] = [];
                $data['respuestas_correctas'] = [];
                $data['nota'] = 0;
                $data['correcto'] = 0;
                $data['incorrecto'] = 0;
            }
            $data['preguntasexamen'] = $_POST['respuesta'];
            $data['id_examen_actual'] = $_POST['id_examen'];

            $data['respuestas_correctas'] = $preguntas->getRespuestasCorrectasByExamen($data['id_examen_actual']);


            var_dump($data['preguntasexamen']);
            // var_dump($data['respuestas_correctas']);
            foreach($data['respuestas_correctas'] as $key => $value){
                if($value['respuesta_correcta'] == $data['preguntasexamen'][$key+1]){
                    $data['nota']++;
                    $data['correcto']++;
                }else{
                    $data['incorrecto']++;
                }
            }

            $notas = Notas::getInstancia();
            $notas->setNota($data['nota']);
            $notas->setIdUsuario($_SESSION['id']);
            $notas->setIdExamen($data['id_examen_actual']);
            $notas->set();

            $data['nota'] = ($data['nota'] * 10) / count($data['respuestas_correctas']);

            $data['preguntas'] = '';


        }

        $this->renderHTML('../app/views/examenes_view.php', $data);
    }

}