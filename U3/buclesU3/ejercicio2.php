<?php
$suma = 0;
$contador = 0;

for ($i = 1; $i <= 10; $i++) {
    if ($i % 2 == 0) {
        $suma += $i;
        $contador++;
        if ($contador == 3) {
            break;
        }
    }
}

echo "La suma de los 3 primeros números pares es: " . $suma;

?>