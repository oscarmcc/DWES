<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas de Multiplicar</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #333;
            color: white;
        }
        .fila-impar {
            background-color: #f2f2f2;
        }
        .columna-principal {
            background-color: #d9edf7;
        }
    </style>
</head>
<body>

<h1>Tablas de Multiplicar del 1 al 10</h1>

<table>
    <thead>
        <tr>
            <th>x</th>
            <?php
                // Cabecera de la tabla (números del 1 al 10)
                for ($i = 1; $i <= 10; $i++) {
                    echo "<th>$i</th>";
                }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
            // Filas de las tablas de multiplicar
            for ($i = 1; $i <= 10; $i++) {
                echo '<tr' . (($i % 2 != 0) ? ' class="fila-impar"' : '') . '>'; // Estilo para filas impares
                echo "<td class='columna-principal'>$i</td>"; // Primera columna de cada fila
                
                for ($j = 1; $j <= 10; $j++) {
                    echo "<td>" . ($i * $j) . "</td>"; // Cálculo de la multiplicación
                }
                
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

</body>
</html>
