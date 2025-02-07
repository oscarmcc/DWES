<?php 
/**
 * @author Alejandro Fernandez Arrayas
 */
include("./config/config.php");
include("./lib/function.php");

//inicializacion de las variables
$nombre = $email = $genero = $vehiculo = $comment = $url = "";
$eNombre = $eEmail = $eGenero = $eComment = $eUrl = $eCoches = $eVehiculos = "";

$cochesSelec = array();
$coloresSelec = array();
$vehiculosSelec = array();

$procesaForm = false;
$eValidacion = false;

if(isset($_POST["enviar"])){
    $procesaForm = true;

    //Validamos el nombre
    if(empty($_POST["name"])){
       $eValidacion = true;
       $eNombre = "* El nombre es obligatorio"; 
    }else{
        $nombre = $_POST["name"];
    }

    //Validamos el Email
    $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $eValidacion = true;
        $eEmail = "* El email no es correcto";
    }

    //Validamos el genero
    if(empty($_POST["genero"])){
        $eValidacion = true;
        $eGenero = "* Seleccionar el genero es obligatorio";
    }else{
        $genero = $_POST["genero"];
    }

    //Validamos coches
    if(empty($_POST["coches"])){
        $eValidacion = true;
        $eCoches = "* Selecciona al menos un coche";
    }else{
        $cochesSelec = $_POST["coches"];
    }

    //Validamos vehiculos
    if(empty($_POST["vehiculo"])){
        $eValidacion = true;
        $eVehiculos = "* Selecciona al menos un vehiculo";
    }else{
        $vehiculosSelec = $_POST["vehiculo"];
    }
}

if($eValidacion){
    $procesaForm=false;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="./estilos/styles.css">
</head>
<body>
    <form action="" method="post">

        <label for="name">Nombre *: </label>
        <input type="text" value="<?php echo "" .$nombre;?>" name="name" id="name">
        <span class="error"><?php echo $eNombre;?></span> <br><br>

        <label for="email">Email *: </label>
        <input type="email" name="email" id="email" value="<?php echo "" .$email;?>"> 
        <span class="error"><?php echo $eEmail;?></span><br><br>

        <label for="url">Url: </label>
        <input type="text" name="url" id="url"><br><br>


        <label>Comentarios: </label>
        <textarea id="comentarios" rows="" cols=""></textarea> <br><br>

        <label>Genero *: </label>
        <?php 
            foreach ($aGenero as $clave => $valor) {
                $check="";
                if($genero == $valor){
                    $check='checked';
                }
                echo '<input type="radio" name="genero" value="'.$valor.'" '.$check.'>'.$valor.'';
            }
        ?>
        <span class="error"><?php echo $eGenero;?></span><br><br>

        <label>Vehiculos *: </label>
        <?php 
            foreach ($aVehiculos as $clave => $valor) {
                $check = "";
                if(in_array($valor, $vehiculosSelec)){
                    $check= "checked";
                }
                echo '<input type="checkbox" name="vehiculo[]" value="'.$valor.'" '.$check.'>'.$valor.'';
            }
        ?>
        <span class="error"><?php echo $eVehiculos;?></span><br><br>

        <label>Coches *: </label>
        <?php 
            foreach ($aCoches as $clave => $valor) {
                $check = "";
                if(in_array($valor, $cochesSelec)){
                    $check='checked';
                }
                echo '<input type="checkbox" name="coches[]" value="'.$valor.'" '.$check.'>'.$valor.'';
            }
        ?>
        <span class="error"><?php echo $eCoches;?></span><br><br>

        <input type="submit" name="enviar" id="enviar">

    </form>
</body>
</html>