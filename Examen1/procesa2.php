<?php
/**
 * 
 * @author oscar <email>
 */
require_once "config.php";
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $correcto = 0;
   $pregunta1 = $_POST['p1'];
    $pregunta2 = $_POST['p2'];
    $pregunta3 = $_POST['p3'];
    $pregunta4 = $_POST['p4'];
    $pregunta5 = $_POST['p5'];

    if(in_array($pregunta1, $aExamen[1][2])){
        $correcto++;
    }
    if(in_array($pregunta2, $aExamen[1][5])){
        $correcto++;
    }
    if(in_array($pregunta3, $aExamen[1][8])){
        $correcto++;
    }
    if(in_array($pregunta4, $aExamen[1][11])){
        $correcto++;
    }
    if(in_array($pregunta5, $aExamen[1][14])){
        $correcto++;
    }

    echo "Tus respuestas han sido <br/>";
    echo "Pregunta 1: " . $pregunta1 . "<br/>";
    echo "Pregunta 2: " . $pregunta2 . "<br/>";
    echo "Pregunta 3: " . $pregunta3 . "<br/>";
    echo "Pregunta 4: " . $pregunta4 . "<br/>";
    echo "Pregunta 5: " . $pregunta5 . "<br/>";
    echo "Correctas: " . $correcto . "<br/>";

    if($correcto == 5 || $correcto == 4){
        echo "Excelente";
      }
      if ($correcto <4 || $correcto >=3){
        echo "Aceptable";
      }
      if ($correcto <2){
        echo "Mejorable";
      }
 }
?>