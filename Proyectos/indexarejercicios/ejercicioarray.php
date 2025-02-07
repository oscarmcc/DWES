<?php
// Obtener la ruta actual desde la URL
$currentDirectory = isset($_GET['path']) ? $_GET['path'] : '/var/www/html/';

// Asegurarse de que la ruta no suba más allá del directorio base
$baseDirectory = '/var/www/html/';
if (strpos(realpath($currentDirectory), $baseDirectory) !== 0) {
    $currentDirectory = $baseDirectory;
}

// Configuración para imágenes de cabecera y colores de fondo según la hora del día y la estación del año
$month = date("n");
if ($month >= 3 && $month <= 5) {
    $headerImage = "imagen/primavera.png";
} elseif ($month >= 6 && $month <= 8) {
    $headerImage = "imagen/verano.png";
} elseif ($month >= 9 && $month <= 11) {
    $headerImage = "imagen/otoño.png";
} else {
    $headerImage = "imagen/invierno.png";
}

$hour = date("H");
if ($hour >= 6 && $hour < 12) {
    $backgroundColor = "#109648";
    $skillsbackground = "#6761A8"; 
} elseif ($hour >= 12 && $hour < 18) {
    $backgroundColor = "#E28413";
    $skillsbackground = "#225560";
} else {
    $backgroundColor = "#2C3E50";
    $skillsbackground = "#EDAE49";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mi Portafolio</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: <?php echo $backgroundColor; ?>;
        }

        header {
            background-image: url('<?php echo $headerImage; ?>');
            background-size: cover;
            color: white;
            padding: 50px;
            text-align: center;
        }

        nav {
            text-align: center;
            margin: 20px 0;
        }

        nav a {
            margin: 0 15px;
            color: #333;
            text-decoration: none;
            font-size: 18px;
        }

        nav a:hover {
            color: #007BFF;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        section {
            margin: 40px 0;
        }

        .skills {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .skills div {
            background-color: <?php echo $skillsbackground; ?>;
            padding: 20px;
            margin: 10px;
            width: 30%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .skills div:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        .folder-card {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            margin: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
        }

        .folder-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        .folder-card a {
            text-decoration: none;
            color: #333;
            font-size: 18px;
            font-weight: bold;
        }

        .folder-card a:hover {
            color: #007BFF;
        }

        .folder-icon {
            font-size: 50px;
            color: #6761A8;
            margin-bottom: 10px;
        }

        .folder-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 40px;
        }

        .back-link {
            display: block;
            margin: 20px 0;
            text-align: center;
            font-size: 16px;
            color: #333;
        }

        .back-link a {
            color: #007BFF;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenido a Mi Portafolio</h1>
        <p>Mi nombre es Óscar y soy Diseñador Web</p>
    </header>

    <nav>
        <a href="#sobre-mi">Sobre Mí</a>
        <a href="#habilidades">Habilidades</a>
        <a href="#contacto">Contacto</a>
    </nav>

    <div class="container">
        <section id="sobre-mi">
            <h2>Sobre Mí</h2>
            <p>Hola, soy Óscar, un Diseñador Web con experiencia en Frontend. Mi objetivo es crear soluciones innovadoras y eficientes.</p>
        </section>

        <section id="habilidades">
            <h2>Habilidades</h2>
            <div class="skills">
                <div>
                    <h3>HTML/CSS</h3>
                    <p>Experto en crear interfaces web responsivas.</p>
                </div>
                <div>
                    <h3>JavaScript</h3>
                    <p>Sólido conocimiento en programación web.</p>
                </div>
                <div>
                    <h3>Diseño UI/UX</h3>
                    <p>Experiencia en diseño de experiencias de usuario amigables.</p>
                </div>
            </div>
        </section>

        <section id="contacto">
            <h2>Contacto</h2>
            <p>Puedes contactarme en: 682 669 306</p>
        </section>

        <section id="carpetas">
            <h2>Carpetas Disponibles</h2>

            <?php
            // Mostrar botón para ir a la carpeta anterior
            if ($currentDirectory != $baseDirectory) {
                $parentDirectory = dirname($currentDirectory);
                echo '<div class="back-link"><a href="?path=' . urlencode($parentDirectory) . '">⬅️ Subir un nivel</a></div>';
            }
            ?>

            <div class="folder-list">
                <?php
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

                // Verificar si la ruta es válida
                if (!is_dir($currentDirectory)) {
                    echo "<p>Error: No se pudo acceder a la carpeta. Ruta intentada: $currentDirectory</p>";
                } else {
                    // Obtener carpetas y archivos
                    $items = scandir($currentDirectory);
                    if (empty($items)) {
                        echo "<p>No se encontraron carpetas ni archivos.</p>";
                    } else {
                        foreach ($items as $item) {
                            if ($item != "." && $item != "..") {
                                $itemPath = $currentDirectory . '/' . $item;
                                if (is_dir($itemPath)) {
                                    // Es una carpeta
                                    echo "
                                    <div class='folder-card'>
                                        <div class='folder-icon'>📁</div>
                                        <a href='?path=" . urlencode(realpath($itemPath)) . "'>$item</a>
                                    </div>";
                                } else {
                                    // Es un archivo
                                    $fileUrl = str_replace($baseDirectory, '', realpath($itemPath));
                                    echo "
                                    <div class='folder-card'>
                                        <div class='folder-icon'>📄</div>
                                        <a href='/$fileUrl'>$item</a>
                                    </div>";
                                }
                            }
                        }
                    }
                }
                ?>
            </div>
        </section>
    </div>

    <footer>
        <p>© 2024 Mi Portafolio. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
