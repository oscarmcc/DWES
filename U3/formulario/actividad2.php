<?php
/**
 * Formulario para crear un currículum que incluya: Campos de texto, grupo de
 *botones de opción, casilla de verificación, lista de selección única, lista de
 * selección múltiple, botón de validación, botón de imagen, botón de reset, etc.
 * 
 * @author Óscar Martín-Castaño Carrillo
 */

// Verifica que se haya enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos básicos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $genero = htmlspecialchars($_POST['genero']);
    $nivel_estudios = htmlspecialchars($_POST['nivel_estudios']);

    // Recoger habilidades seleccionadas (si existen)
    $habilidades = isset($_POST['habilidades']) ? $_POST['habilidades'] : [];

    // Recoger idiomas seleccionados (si existen)
    $idiomas = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];

    echo "<h1>Currículum de $nombre</h1>";
    echo "<p><strong>Correo Electrónico:</strong> $email</p>";
    echo "<p><strong>Teléfono:</strong> $telefono</p>";
    echo "<p><strong>Género:</strong> $genero</p>";
    echo "<p><strong>Nivel de Estudios:</strong> $nivel_estudios</p>";

    // Mostrar habilidades
    echo "<p><strong>Habilidades:</strong> ";
    if (!empty($habilidades)) {
        echo implode(", ", array_map('htmlspecialchars', $habilidades));
    } else {
        echo "No se seleccionaron habilidades.";
    }
    echo "</p>";

    // Mostrar idiomas
    echo "<p><strong>Idiomas:</strong> ";
    if (!empty($idiomas)) {
        echo implode(", ", array_map('htmlspecialchars', $idiomas));
    } else {
        echo "No se seleccionaron idiomas.";
    }
    echo "</p>";
} else {
    echo "<p>No se ha enviado ningún formulario.</p>";
}
?>
