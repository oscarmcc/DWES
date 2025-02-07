<?php
// Si ya se envió el formulario, se revisan las respuestas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['correct']) && isset($_POST['user'])) {
    $correct_answers = $_POST['correct'];
    $user_answers = $_POST['user'];
    $positions = $_POST['positions'];

    echo "<h3>Resultados:</h3>";
    for ($i = 0; $i < count($correct_answers); $i++) {
        $correct = intval($correct_answers[$i]);  // Asegurar que las respuestas correctas sean enteros
        $user = intval($user_answers[$i]);        // Convertir las respuestas del usuario a enteros
        
        // Obtener la posición de la celda
        $pos = $positions[$i];
        
        if ($correct === $user) {
            echo "Respuesta en $pos: Correcta! El valor era $correct<br>";
        } else {
            echo "Respuesta en $pos: Incorrecta! El valor correcto era $correct y tú pusiste $user<br>";
        }
    }
} else {
    // Si no se ha enviado, muestra el formulario para ingresar el número de huecos
?>
    <form method="post">
        <label for="holes">¿Cuántos huecos aleatorios quieres llenar? (Entre 1 y 10): </label>
        <input type="number" id="holes" name="holes" min="1" max="10" required>
        <button type="submit">Generar tabla</button>
    </form>
<?php
}

if (isset($_POST['holes'])) {
    $holes = intval($_POST['holes']);
    
    // Validar que el número de huecos esté entre 1 y 10
    if ($holes < 1 || $holes > 10) {
        echo "<p>El número de huecos debe estar entre 1 y 10.</p>";
        exit();
    }

    // Crear la tabla de multiplicar 10x10 con encabezados
    echo "<form method='post'>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    
    // Crear encabezado de columna (números del 1 al 10)
    echo "<tr><th></th>"; // Celda vacía en la esquina superior izquierda
    for ($col_header = 1; $col_header <= 10; $col_header++) {
        echo "<th>$col_header</th>";
    }
    echo "</tr>";

    $selected_positions = [];
    $correct_answers = [];
    $positions = [];
    
    // Generar posiciones aleatorias para los huecos
    for ($n = 0; $n < $holes; $n++) {
        do {
            $i = rand(1, 10);
            $j = rand(1, 10);
            $new_pos = [$i, $j];
        } while (in_array($new_pos, $selected_positions)); // Evitar duplicados
        $selected_positions[] = $new_pos;
        $correct_answers[] = $i * $j;
        $positions[] = "($i,$j)"; // Guardar la posición
    }
    
    // Crear la tabla con la fila extra de números del 1 al 10
    for ($i = 1; $i <= 10; $i++) {
        echo "<tr>";
        // Encabezado de fila (número del 1 al 10)
        echo "<th>$i</th>";
        
        for ($j = 1; $j <= 10; $j++) {
            $is_selected = false;
            // Revisar si esta posición fue seleccionada aleatoriamente
            foreach ($selected_positions as $pos) {
                if ($pos[0] == $i && $pos[1] == $j) {
                    $is_selected = true;
                    break;
                }
            }
            
            if ($is_selected) {
                echo "<td><input type='number' name='user[]' required></td>";
            } else {
                echo "<td>" . ($i * $j) . "</td>";
            }
        }
        echo "</tr>";
    }
    
    // Guardar respuestas correctas y las posiciones
    foreach ($correct_answers as $correct) {
        echo "<input type='hidden' name='correct[]' value='$correct'>";
    }
    foreach ($positions as $pos) {
        echo "<input type='hidden' name='positions[]' value='$pos'>";
    }
    
    echo "</table>";
    echo "<button type='submit'>Enviar respuestas</button>";
    echo "</form>";
}
?>
