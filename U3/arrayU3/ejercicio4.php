<?php
/**
 * Un restaurante dispone de una carta de 3 primeros, 5 segundos y 3 postres.
 * Almacenar información incluyendo foto y mostrar los menús disponibles. Mostrar el
 * precio del menú suponiendo que éste se calcula sumando el precio de cada uno de
 * los platos incluidos y con un descuento del 20 %.
 * 
 */
$primeros = [
    [
        'nombre' => 'Ensalada César',
        'precio' => 7.50,
        'foto' => 'ensalada_cesar.jpg'
    ],
    [
        'nombre' => 'Sopa de Tomate',
        'precio' => 6.00,
        'foto' => 'sopa_tomate.jpg'
    ],
    [
        'nombre' => 'Pimientos Rellenos',
        'precio' => 8.00,
        'foto' => 'pimientos_rellenos.jpg'
    ]
];

$segundos = [
    [
        'nombre' => 'Pollo al Horno',
        'precio' => 12.00,
        'foto' => 'pollo_horno.jpg'
    ],
    [
        'nombre' => 'Merluza a la Plancha',
        'precio' => 15.00,
        'foto' => 'merluza_plancha.jpg'
    ],
    [
        'nombre' => 'Bistec de Ternera',
        'precio' => 14.00,
        'foto' => 'bistec_ternera.jpg'
    ],
    [
        'nombre' => 'Paella de Marisco',
        'precio' => 18.00,
        'foto' => 'paella_marisco.jpg'
    ],
    [
        'nombre' => 'Lasaña Vegetariana',
        'precio' => 10.00,
        'foto' => 'lasana_vegetariana.jpg'
    ]
];

$postres = [
    [
        'nombre' => 'Tarta de Chocolate',
        'precio' => 4.00,
        'foto' => 'tarta_chocolate.jpg'
    ],
    [
        'nombre' => 'Fruta de Temporada',
        'precio' => 3.00,
        'foto' => 'fruta_temporada.jpg'
    ],
    [
        'nombre' => 'Helado Variado',
        'precio' => 3.50,
        'foto' => 'helado_variado.jpg'
    ]
];

// Función para calcular el precio total del menú
function calcularPrecioMenu($primer, $segundo, $postre) {
    $precioTotal = $primer['precio'] + $segundo['precio'] + $postre['precio'];
    $descuento = $precioTotal * 0.20; // 20% de descuento
    return $precioTotal - $descuento;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú del Restaurante</title>
    <style>
        .menu {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            display: inline-block;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Menú del Restaurante</h1>

    <h2>Menús Disponibles</h2>
    <?php foreach ($primeros as $primer): ?>
        <?php foreach ($segundos as $segundo): ?>
            <?php foreach ($postres as $postre): ?>
                <div class="menu">
                    <h3><?php echo $primer['nombre']; ?>, <?php echo $segundo['nombre']; ?>, <?php echo $postre['nombre']; ?></h3>
                    <img src="fotos/<?php echo $primer['foto']; ?>" alt="<?php echo $primer['nombre']; ?>">
                    <img src="fotos/<?php echo $segundo['foto']; ?>" alt="<?php echo $segundo['nombre']; ?>">
                    <img src="fotos/<?php echo $postre['foto']; ?>" alt="<?php echo $postre['nombre']; ?>">
                    <p>Precio Total: <?php echo calcularPrecioMenu($primer, $segundo, $postre); ?> €</p>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
</body>
</html>
