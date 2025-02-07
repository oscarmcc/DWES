<?php
/**
 * Test 2 Formulario que tenga grupo, curso y formato (linux o mysql).
 */

include "./config.php";

// Obtener el mes y año actuales
$mesActual = 4;
$aActual = 2024;
$av_array = [];
$check ="";
// Generar el array de cursos
for ($i = A_INICIO; $i <= A_FINAL; $i++) {
    $anno = $i . "/" . ($i + 1);
    
    // Verificar si es el curso actual para marcarlo por defecto
    if (($i == $aActual && $mesActual > 8) || ($i+1 == $aActual && $mesActual < 8))  {
        $check = true;
        $av_array[] = [$anno, $check]; // Marca como seleccionado
    } else {
        $check = false;
        $av_array[] = [$anno, $check]; // No marcado
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario DAW</title>
</head>
<body>
    <h2>Formulario para grupos DAW</h2>

    <form action="procesatest2.php" method="post" enctype="multipart/form-data">
        <!-- Grupo -->
        <label for="grupo">Grupo:</label> 
        <select name="grupo" id="grupo" required>
            <?php foreach ($grupos as $grupo): ?>
                <option value="<?php echo htmlspecialchars($grupo); ?>"><?php echo htmlspecialchars($grupo); ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <!-- Curso -->
        <label for="curso">Curso:</label> 
        <select name="curso" id="curso" required>
            <?php foreach ($av_array as $curso): ?>
                <option value="<?php echo htmlspecialchars($curso[0]); ?>" <?php echo $curso[1] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($curso[0]); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <!-- Formato -->
        <label for="formato">Formato:</label> 
        <select name="formato" id="formato" required>
            <?php foreach ($formatos as $formato): ?>
                <option value="<?php echo htmlspecialchars($formato); ?>"><?php echo htmlspecialchars($formato); ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="file" name="file" id="file"><br/><br/>

        <!-- Botón de envío -->
        <input type="submit" value="Enviar" name="enviar">
    </form>
</body>
</html>
