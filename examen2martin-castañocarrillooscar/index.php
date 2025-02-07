<?php
/**
 * Realización del ejercicio
 */

 require_once "config.php";
 session_start();
 if(!isset($_SESSION['nombre'])){
     $_SESSION['nombre'] = 'Oscar';
     $_SESSION['apellidos'] = 'Martín-Castaño';
 }

 $aBanca= array();
 $aJugador= array();
 for($i=0;$i<2;$i++){
    array_push($aBanca, array_rand($aCartas));
    array_push($aJugador, array_rand($aCartas));
 }

 var_dump($aBanca);
 var_dump($aJugador);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El 21</title>
</head>
<body>
    <form method="post">
        <button type="submit" name="robar"></button>
    </form>

    <h2>Carta de la banca:</h2>
    <?php
    $auxiliarBanca= $aBanca[0];
    echo "<p>".$aCartas["$auxiliarBanca"] ."</p>"
    ?>

    <h2>Tus cartas:</h2>
    <?php
    foreach($aJugador as $clave => $valor){
        echo "<p>".$aCartas[$valor]."</p>" ;
    }
    ?>

</body>
</html>