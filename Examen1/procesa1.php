<?php
/**
 * 
 * @author oscar <email>
 */
require_once "config.php";
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $correcto = 0;
    $pregunta1 = isset($_POST['pregunta1']) ? $_POST['pregunta1'] : [];
    $pregunta2 = isset($_POST['pregunta2']) ? $_POST['pregunta2'] : [];
    $pregunta3 = isset($_POST['pregunta3']) ? $_POST['pregunta3'] : [];
    $pregunta4 = $_POST['p4'];
    $pregunta5 = $_POST['p5'];

    foreach($pregunta1 as $clave){
      if(in_array($clave, $aExamen[0][2])){
         $correcto++;
      }
    }
    foreach($pregunta2 as $clave){
      if(in_array($clave, $aExamen[0][5])){
         $correcto++;
      }
    }
    foreach($pregunta3 as $clave){
      if(in_array($clave, $aExamen[0][8])){
         $correcto++;
      }
    }

    if(in_array($pregunta4, $aExamen[0][11])){
      $correcto++;
    }
    if(in_array($pregunta5, $aExamen[0][14])){
      $correcto++;
    }

    echo "Tus respuestas han sido <br/>";
    echo "Pregunta 1: ";
    foreach($pregunta1 as $clave){
      echo $clave . " ";
    }
    echo "<br/>";
    echo "Pregunta 2: ";
    foreach($pregunta2 as $clave){
      echo $clave . " ";
    }
    echo "<br/>";
    echo "Pregunta 3: ";
    foreach($pregunta3 as $clave){
      echo $clave . " ";
    }
    echo "<br/>";
    echo "Pregunta 4: " . $pregunta4 . "<br/>";
    echo "Pregunta 5: " . $pregunta5 . "<br/>";
    echo "Correctas: " . $correcto . "<br/>";

    if($correcto == 7 || $correcto == 6){
      echo "Excelente";
    }
    if ($correcto <6 || $correcto >=4){
      echo "Aceptable";
    }
    if ($correcto <3){
      echo "Mejorable";
    }
 }
?>