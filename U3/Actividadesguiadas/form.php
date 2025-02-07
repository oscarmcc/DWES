<?php
/**
 * @author: Óscar Martín-Castaño
 * 
 */

$lProcesaFormulario = false;
$nombre = "";
$apellidos = "";
$email = "";

if(isset($_POST[`enviar`])){
    $lProcesaFormulario = true;
}
if ($lProcesaFormulario){
    //Recogemos los datos
    $nombre = $_POST[`nombre`];
    $apellidos = $_POST[`apellidos`];
    $email = $_POST[`email`];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $lProcesaFormulario = false;
    }
}else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if ($lProcesaFormulario){
        //Mostrar
        echo "Nombre: $nombre";
        echo "Apellidos: $apellidos";
        echo "Email: $email";
    }else{
    ?>

    <form action="procesa.php" method="post"></br>
        <input type="text" name="nombre" value="<?php $nombre?>"></br>
        <input type="text" name="apellido" id=""></br>
        <input type="text" name="email" id=""></br>
        <input type="submit" name="enviar" value="enviar">
    </form>
    <?php
    }
    ?>
</body>
</html>

<?php
}
?>