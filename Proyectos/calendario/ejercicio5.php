<?php
// Establecer el mes y año deseado
$mes = 10; // Septiembre
$año = 2024;

// Obtener el primer día del mes y el número total de días en el mes
$fecha = new DateTime("$año-$mes-01");
$totalDias = $fecha->format('t');
$primerDiaSemana = $fecha->format('N'); // 1 (Lunes) a 7 (Domingo)

// Días festivos (puedes agregar más festivos según sea necesario)
$festivos = [
    "2024-01-01", // Año Nuevo
    "2024-01-06", // Reyes Magos
    "2024-03-29", // Viernes Santo
    "2024-04-01", // Lunes de Pascua
    "2024-05-01", // Día del Trabajo
    "2024-08-15", // Asunción de la Virgen
    "2024-10-12", // Fiesta Nacional de España
    "2024-11-01", // Todos los Santos
    "2024-12-06", // Día de la Constitución
    "2024-12-08", // Inmaculada Concepción
    "2024-12-25", // Navidad
];

// Obtener la fecha actual
$fechaHoy = date("Y-m-d");

// Mostrar el encabezado del calendario
echo "<h1>Calendario de $fecha->format('F Y')</h1>";
echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr>
        <th>Lunes</th>
        <th>Martes</th>
        <th>Miércoles</th>
        <th>Jueves</th>
        <th>Viernes</th>
        <th>Sábado</th>
        <th>Domingo</th>
      </tr><tr>";

// Rellenar los espacios vacíos del primer día
for ($i = 1; $i < $primerDiaSemana; $i++) {
    echo "<td></td>";
}

// Mostrar los días del mes
for ($dia = 1; $dia <= $totalDias; $dia++) {
    // Formatear la fecha actual
    $fechaActual = sprintf("%04d-%02d-%02d", $año, $mes, $dia);
    
    // Comprobar si es el día actual o un festivo
    if ($fechaActual === $fechaHoy) {
        echo "<td style='background-color: green; color: white;'>$dia</td>"; // Día actual
    } elseif (in_array($fechaActual, $festivos)) {
        echo "<td style='background-color: red; color: white;'>$dia</td>"; // Día festivo
    } else {
        echo "<td>$dia</td>"; // Días normales
    }

    // Si es domingo, cerrar la fila
    if (($primerDiaSemana + $dia - 1) % 7 == 0) {
        echo "</tr><tr>";
    }
}

// Rellenar los espacios vacíos al final del mes
while (($primerDiaSemana + $totalDias - 1) % 7 != 0) {
    echo "<td></td>";
    $totalDias++;
}

echo "</tr></table>";
?>
