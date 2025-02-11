<?php
// Iniciamos la sesion y definimos la constante COLORES
session_start();

define("COLORES", ["Red", "Blue", "Green", "Yellow", "Orange", "Purple"]);

// Si no existe la variable de sesion colores, la creamos y le asignamos 4 colores aleatorios
if (!isset($_SESSION['colores'])) {
    $_SESSION['colores'] = [];
    for ($i = 0; $i < 4; $i++) {
        $_SESSION['colores'][] = COLORES[rand(0, count(COLORES) - 1)];
    }
}

// Si no existe la variable de sesion resultados, la creamos
if (!isset($_SESSION['fila_actual'])) {
    $_SESSION['fila_actual'] = 0;
}

$aciertos = $casiAciertos = 0;

// Si se ha enviado el formulario, comprobamos los colores
if (isset($_POST['colores'])) {
    $fila_actual = $_SESSION['fila_actual'];
    if (isset($_POST['colores'][$fila_actual])) {
        $intento = $_POST['colores'][$fila_actual];
        $resultadoFila = ['colores' => [], 'aciertos' => 0, 'casi_aciertos' => 0];
        foreach ($_POST['colores'][$fila_actual] as $key => $value) {
            if ($value == $_SESSION['colores'][$key]) {
                $resultadoFila['aciertos']++;
                $resultadoFila['colores'][$key] = ['valor' => $value, 'estado' => 'acertado'];
            } elseif (in_array($value, $_SESSION['colores'])) {
                $resultadoFila['casi_aciertos']++;
                $resultadoFila['colores'][$key] = ['valor' => $value, 'estado' => 'casi_acertado'];
            } else {
                $resultadoFila['colores'][$key] = ['valor' => $value, 'estado' => 'no_acertado'];
            }
        }
        $_SESSION['resultados'][$fila_actual] = $resultadoFila;
        if ($resultadoFila['aciertos'] < 4) {
            $_SESSION['fila_actual']++;
        }
    }
}
echo "<style>
    .acertado{
        background-color: green;
    }
        .casi_acertado{
        background-color: yellow;}
        .no_acertado{
        background-color: red;}
    </style>";



echo "<h1>Wordle de colores</h1>";
echo "<h2>Colores disponibles</h2>";
echo "<ul>";
foreach (COLORES as $color) {
    echo "<li>$color</li>";
}
echo "</ul>";

echo "<p>De primeras sale todo rojo no pasa nada</p>";

// Si se ha pulsado el botón de comprobar, comprobamos los colores y deshabilitamos la fila; Además mostramos cual esta correcto y cual incorrecto
echo "<form method='post'>";
for ($i = 0; $i < 6; $i++) {
    echo "<div>";
    for ($j = 0; $j < 4; $j++) {
        $valor="";
        $clase = "no_acertado";
        if(isset($_SESSION['resultados'][$i]['colores'][$j])){
            $valor = $_SESSION['resultados'][$i]['colores'][$j]['valor'];
            $clase = $_SESSION['resultados'][$i]['colores'][$j]['estado'];
        }
        $disabled = ($i < $_SESSION['fila_actual']) ? "disabled" : "";
        echo "<input type='text' name='colores[$i][$j]' value='$valor' class='$clase' $disabled>";
    }

    if (isset($_SESSION['resultados'][$i])) {
        echo " - Aciertos: {$_SESSION['resultados'][$i]['aciertos']}, Casi aciertos: {$_SESSION['resultados'][$i]['casi_aciertos']}";
    }
    echo "</div>";
}


if ($_SESSION['fila_actual'] < 6) {
    echo "<input type='submit' name='comprobar' value='Comprobar'>";
}

echo "</form>";


var_dump($_SESSION);
