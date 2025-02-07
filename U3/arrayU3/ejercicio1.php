<?php
/**
 * Definir un array que permita almacenar y mostrar la siguiente información.
 * a. Meses del año.
 * b. Tablero para jugar al juego de los barcos.
 * c. Nota de los alumnos de 2o DAW para el módulo DWES.
 * d. Verbos irregulares en inglés.
 * e. Información sobre continentes, países, capitales y banderas.
 * 
 */

$mesesDelAno = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
echo "Meses del año:\n";
print_r($mesesDelAno);

$tableroBarcos = [
    ['~', '~', '~', '~', '~'],
    ['~', 'B', '~', '~', '~'],
    ['~', '~', 'B', '~', '~'],
    ['~', '~', '~', '~', '~'],
    ['~', '~', '~', 'B', 'B']
  ];
echo "Tablero de los barcos:\n";
foreach ($tableroBarcos as $fila) {
    echo implode(" ", $fila) . "\n";
  }
echo '<br/>';

$notasAlumnosDAW = [
    ["nombre" => "Juan", "nota" => 8.5],
    ["nombre" => "Ana", "nota" => 9.0],
    ["nombre" => "Luis", "nota" => 7.3],
    ["nombre" => "María", "nota" => 8.9]
  ];
  
echo "Notas de los alumnos de 2º DAW en DWES:\n";
foreach ($notasAlumnosDAW as $alumno) {
    echo $alumno['nombre'] . " tiene una nota de " . $alumno['nota'] . "\n";
  }

  echo '<br/>';
$verbosIrregulares = [
    ["infinitivo" => "be", "pasado" => "was/were", "participio" => "been"],
    ["infinitivo" => "begin", "pasado" => "began", "participio" => "begun"],
    ["infinitivo" => "break", "pasado" => "broke", "participio" => "broken"],
    ["infinitivo" => "choose", "pasado" => "chose", "participio" => "chosen"]
  ];
  
echo "Verbos irregulares en inglés:\n";
foreach ($verbosIrregulares as $verbo) {
    echo "Infinitivo: " . $verbo['infinitivo'] . ", Pasado: " . $verbo['pasado'] . ", Participio: " . $verbo['participio'] . "\n";
  }

  echo '<br/>';
$informacionContinentes = [
    "América" => [
      ["pais" => "Argentina", "capital" => "Buenos Aires", "bandera" => "🇦🇷"],
      ["pais" => "Brasil", "capital" => "Brasilia", "bandera" => "🇧🇷"],
      ["pais" => "Canadá", "capital" => "Ottawa", "bandera" => "🇨🇦"]
    ],
    "Europa" => [
      ["pais" => "Francia", "capital" => "París", "bandera" => "🇫🇷"],
      ["pais" => "España", "capital" => "Madrid", "bandera" => "🇪🇸"],
      ["pais" => "Alemania", "capital" => "Berlín", "bandera" => "🇩🇪"]
    ]
  ];
  
echo "Información de continentes, países, capitales y banderas:\n";
foreach ($informacionContinentes as $continente => $paises) {
    echo "Continente: $continente\n";
    foreach ($paises as $pais) {
      echo "País: " . $pais['pais'] . ", Capital: " . $pais['capital'] . ", Bandera: " . $pais['bandera'] . "\n";
    }
  }
?>
