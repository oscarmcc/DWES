<?php

// Almacena tres números en variables y escribirlos en pantalla de manera ordenada.
$numero1 = 15;
$numero2 = 8;
$numero3 = 42;


if ($numero1 > $numero2) {
    $temp = $numero1;
    $numero1 = $numero2;
    $numero2 = $temp;
}

if ($numero2 > $numero3) {
    $temp = $numero2;
    $numero2 = $numero3;
    $numero3 = $temp;
}

if ($numero1 > $numero2) {
    $temp = $numero1;
    $numero1 = $numero2;
    $numero2 = $temp;
}

echo "$numero1 $numero2 $numero3";
?>
