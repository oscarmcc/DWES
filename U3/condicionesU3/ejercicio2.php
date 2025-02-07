<?php
/* Carga en variables mes y año e indica el número de días del mes. Utiliza la
estructura de control switch */

$mes = 2; 
$año = 2024;

$dias = 0;

switch ($mes) {
    case 1:
    case 3:
    case 5:
    case 7:
    case 8:
    case 10:
    case 12:
        $dias = 31;
        break;
        
    case 4:
    case 6:
    case 9:
    case 11:
        $dias = 30;
        break;

    case 2:
        if (($año % 4 == 0 && $año % 100 != 0) || ($año % 400 == 0)) {
            $dias = 29;
        } else {
            $dias = 28;
        }
        break;

    default:
        echo "Mes inválido.";
        exit();
}

echo "El mes $mes del año $anio tiene $dias días.";
?>
