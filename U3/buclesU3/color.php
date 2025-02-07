<?php
// Obtener el color de la URL y decodificarlo
$colorSeleccionado = isset($_GET['color']) ? urldecode($_GET['color']) : '#FFFFFF';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color Seleccionado</title>
    <style>
        body {
            background-color: <?php echo $colorSeleccionado; ?>;
            color: #333;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        h1 {
            font-size: 3em;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>

<h1>Color: <?php echo htmlspecialchars($colorSeleccionado); ?></h1>

</body>
</html>
