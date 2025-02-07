<?php
session_start();

// Configuración del tiempo de sesión
$_SESSION['intervaloTime'] = 1; // Tiempo en minutos
if (!isset($_SESSION['inicioTime'])) {
    $_SESSION['inicioTime'] = time();
    $_SESSION['contador'] = 0; // Inicializa el contador de pulsaciones
}

$tiempo_transcurrido = time();
$tiempo_maximo = $_SESSION['inicioTime'] + ($_SESSION['intervaloTime'] * 60);

// Verificar si el tiempo máximo ha pasado
if ($tiempo_transcurrido > $tiempo_maximo) {
    header("Location: salir.php"); // Redirigir a salir.php si se supera el tiempo máximo
    exit(); // Asegurarse de que no se ejecute más código
}

// Contador de pulsaciones
function pulsa() {
    $_SESSION['contador']++;
    $_SESSION['inicioTime'] = time(); // Resetea el inicio al pulsar
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de Pulsaciones</title>
</head>
<body>
    <h1>Contador de Pulsaciones</h1>
    <p>Pulsaciones actuales: <?php echo $_SESSION['contador']; ?></p>
    
    <!-- Enlace para incrementar el contador -->
    <a href=<?php pulsa();?>>¡Pulsa aquí!</a>
    
    <p>Tienes un minuto para pulsar de nuevo o el contador se reiniciará.</p>
</body>
</html>
