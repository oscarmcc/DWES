<?php
// Carga fecha de nacimiento en variables y calcula la edad.

$dia_nacimiento = 15;
$mes_nacimiento = 10;
$año_nacimiento = 1995;

$dia_actual = date("d");
$mes_actual = date("m");
$año_actual = date("Y");

$edad = $año_actual - $año_nacimiento;

if ($mes_actual < $mes_nacimiento || ($mes_actual == $mes_nacimiento && $dia_actual < $dia_nacimiento)) {
    $edad--;
}

echo "La persona tiene $edad años.";
?>