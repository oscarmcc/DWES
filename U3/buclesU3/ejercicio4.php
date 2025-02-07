<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paleta de Colores</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid black;
        }
        td a {
            display: block;
            padding: 15px;
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>

<h1>Paleta de Colores</h1>

<table>
    <tr>
        <th>Color</th>
        <th>Valor Hexadecimal</th>
    </tr>
    <?php
        // Array de colores en hexadecimal
        $colores = [
            "#FF5733", "#33FF57", "#3357FF", "#FF33A8", "#33FFF6",
            "#F3FF33", "#FF8C33", "#8C33FF", "#33FFCC", "#FF3333"
        ];

        // Mostrar la tabla con los colores
        foreach ($colores as $color) {
            // Codificar el color para que el símbolo # no cause problemas en la URL
            $encodedColor = urlencode($color);
            echo "<tr>";
            echo "<td style='background-color: $color;'><a href='color.php?color=$encodedColor' style='color: white;'>$color</a></td>";
            echo "<td><a href='color.php?color=$encodedColor'>$color</a></td>";
            echo "</tr>";
        }
    ?>
</table>

</body>
</html>
