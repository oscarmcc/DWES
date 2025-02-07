<?php
/**
 * Test 1 para comprobar el manejo de ficheros de texto sin duplicados y con números en caso de repetición
 */

include "./config.php";
// Declaración de variables
$desglose = [];
$alumno = "";
$aUsuarios = [];
$nombreUsuario = "";

// Array para contar duplicados
$contadorNombres = [];

// Abrir el fichero
$file = fopen("RegMisAlu.csv", "r");

// Despreciamos línea de cabecera
for ($i = 0; $i < LINE_CABECERA; $i++) { 
    fgets($file);
}

// Recorremos el fichero mostrando los alumnos hasta feof
while (!feof($file)) {
    // Cargamos el fichero
    $alumno = fgets($file);
    // Reemplazamos los caracteres especiales
    $alumno_st = str_replace($caracteresBusqueda, $caracteresRemplaza, $alumno);

    // Lo pasamos a minúscula
    $alumno_minuscula = strtolower($alumno_st);
    $desglose = explode(" ", $alumno_minuscula);

    // Crear el nombre de usuario con las primeras letras
    $nombreBase = substr($desglose[0], 1, 3) . substr($desglose[1], 0, 2) . substr($desglose[2], 0, 2);

    // Verificar si el nombre base ya existe en el array de usuarios
    if (isset($contadorNombres[$nombreBase])) {
        // Incrementamos el contador y creamos el nombre con el número al final
        $contadorNombres[$nombreBase]++;
        $nombreUsuario = $nombreBase . $contadorNombres[$nombreBase];
    } else {
        // Inicializamos el contador y usamos el nombre base sin número
        $contadorNombres[$nombreBase] = 1;
        $nombreUsuario = $nombreBase;
    }

    // Añadimos el nombre único al array de usuarios
    $aUsuarios[] = $nombreUsuario;
}

fclose($file);

// Mostrar cada nombre de usuario en una nueva línea
foreach ($aUsuarios as $usuario) {
    echo $usuario . "<br/>";
}
?>
