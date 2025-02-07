<?php
/**
 * 
 * @author: Óscar Martín-Castaño
 */

// Si las cookies ya existen, las recuperamos para mostrarlas en el formulario
$nombre = isset($_COOKIE['nombre']) ? $_COOKIE['nombre'] : '';
$contraseña = isset($_COOKIE['contraseña']) ? $_COOKIE['contraseña'] : '';
$recordar = isset($_COOKIE['recordar']) ? $_COOKIE['recordar'] : false;

$lProcesaFormulario = false;

if (isset($_POST['enviar'])) {
    $lProcesaFormulario = true;
    // Recogemos los datos
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];

    if (isset($_POST['recordar']) && $_POST['recordar'] == "True") {
        // Si el checkbox está marcado, guardamos los datos en cookies
        setcookie("nombre", $nombre, time() + 3600);
        setcookie("contraseña", $contraseña, time() + 3600);
        setcookie("recordar", true, time() + 3600);
    } else {
        // Si no se marcó "recordar", eliminamos las cookies
        setcookie("nombre", "", time() - 3600);
        setcookie("contraseña", "", time() - 3600);
        setcookie("recordar", "", time() - 3600);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
<?php
if ($lProcesaFormulario) {
    // Mostrar los valores enviados
    echo "Nombre: $nombre<br>";
    echo "Contraseña: $contraseña<br>";
} else {
?>

<form action="" method="post">
    <label for="nombre">Usuario:</label>
    <input type="text" name="nombre" id="user" value="<?php echo htmlspecialchars($nombre); ?>" required><br>

    <label for="contraseña">Contraseña:</label>
    <input type="password" name="contraseña" id="contraseña" value="<?php echo htmlspecialchars($contraseña); ?>" required><br>

    <label for="recordar">¿Quieres guardar los datos?</label>
    <input type="checkbox" name="recordar" value="True" <?php if ($recordar) echo 'checked'; ?>><br>

    <input type="submit" name="enviar" value="Enviar">
</form>

<?php
}
?>
</body>
</html>
