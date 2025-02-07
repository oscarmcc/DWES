<?php
define("LINE_CABECERA", 1);
define("A_INICIO", 2010);
define("A_FINAL", 2030);

// Directorio para la subida de los archivos
define("DIRUPLOAD", 'upload/');

// Tamaño máximo de los archivos
define("MAXSIZE", 200000);

// Extensión permitida
$allowedExts = array("csv");
$allowedFormat = array("text/csv");

$caracteresBusqueda = array("Á", "á", "É", "é", "Í", "í", "Ó", "ó", "Ú", "ú", "Ú", "ü", "Ñ", "ñ", ",", "\"");

$caracteresRemplaza = array("A", "a", "E", "e", "I", "i", "O", "o", "U", "u","N", "n", " ", " ");

$grupos = ["1º DAW", "2º DAW", "1º ASIR", "2º ASIR"];

$formatos = ["Linux", "MySQL"];

?>