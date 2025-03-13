<?php
// Establecer el mes y año deseado
$mes = 10; // Octubre
$año = 2024;

// Obtener el primer día del mes y el número total de días en el mes
$fecha = new DateTime("$año-$mes-01");
$totalDias = $fecha->format('t');
$primerDiaSemana = $fecha->format('N'); // 1 (Lunes) a 7 (Domingo)

// Días festivos con tipos
$festivos = [
    "2024-01-01" => 'nacional',      // Año Nuevo
    "2024-01-06" => 'nacional',      // Reyes Magos
    "2024-03-29" => 'semana_santa',  // Viernes Santo
    "2024-04-01" => 'semana_santa',  // Lunes de Pascua
    "2024-05-01" => 'nacional',      // Día del Trabajo
    "2024-08-15" => 'nacional',      // Asunción de la Virgen
    "2024-10-12" => 'nacional',      // Fiesta Nacional de España
    "2024-11-01" => 'nacional',      // Todos los Santos
    "2024-12-06" => 'nacional',      // Día de la Constitución
    "2024-12-08" => 'nacional',      // Inmaculada Concepción
    "2024-12-25" => 'nacional',      // Navidad
    "2024-02-28" => 'comunidad',     // Día de la Comunidad (ejemplo)
    "2024-10-24" => 'local',         // Festivo Local (ejemplo)
];

// Obtener la fecha actual
$fechaHoy = date("Y-m-d");

// Mostrar el encabezado del calendario
echo "<h1>Calendario de " . $fecha->format('F Y') . "</h1>";
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

// Colores para los tipos de festivos
$coloresFestivos = [
    'nacional' => 'red',
    'comunidad' => 'blue',
    'local' => 'orange',
    'semana_santa' => 'purple',
];

// Mostrar los días del mes
for ($dia = 1; $dia <= $totalDias; $dia++) {
    // Formatear la fecha actual
    $fechaActual = sprintf("%04d-%02d-%02d", $año, $mes, $dia);
    
    // Determinar el estilo basado en si es el día actual, festivo o normal
    if ($fechaActual === $fechaHoy) {
        echo "<td style='background-color: green; color: white;'>$dia</td>"; // Día actual
    } elseif (array_key_exists($fechaActual, $festivos)) {
        // Obtener el tipo de festivo y el color correspondiente
        $tipoFestivo = $festivos[$fechaActual];
        $colorFestivo = $coloresFestivos[$tipoFestivo];
        echo "<td style='background-color: $colorFestivo; color: white;'>$dia</td>"; // Día festivo
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
