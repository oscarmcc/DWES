<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Subida de Archivos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #fff;
            padding: 20px;
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
        }
        form {
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            text-align: center;
            width: 350px;
            margin-bottom: 30px;
        }
        input[type="file"] {
            margin-top: 10px;
            border: none;
            color: #fff;
        }
        input[type="submit"] {
            background-color: #ff6b6b;
            color: #fff;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1em;
            transition: all 0.3s ease;
            margin-top: 15px;
        }
        input[type="submit"]:hover {
            background-color: #d9534f;
            transform: translateY(-2px);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .gallery-item {
            background-color: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
            width: 180px;
            text-align: center;
            transition: transform 0.3s;
        }
        .gallery-item:hover {
            transform: translateY(-5px);
        }
        .gallery-item img {
            width: 100%;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }
        .gallery-item img:hover {
            transform: scale(1.05);
        }
        .delete-link {
            display: inline-block;
            margin-top: 10px;
            color: #ff6b6b;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }
        .delete-link:hover {
            color: #d9534f;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>Galería de Subida de Archivos</h1>

    <!-- Formulario para subir archivos -->
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">Seleccione un archivo:</label><br>
        <input type="file" name="file" id="file" required><br />
        <input type="submit" name="submit" value="Subir">
    </form>

    <?php
    define("DIRUPLOAD", 'upload/');
    define("MAXSIZE", 200000);
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $allowedFormat = array("image/gif", "image/jpeg", "image/jpg", "image/png", "image/x-png");

    // Eliminar archivo si se recibe el parámetro 'delete'
    if (isset($_GET['delete'])) {
        $fileToDelete = DIRUPLOAD . basename($_GET['delete']);
        if (file_exists($fileToDelete)) {
            unlink($fileToDelete);
            echo "<p style='color: #ff6b6b;'>Imagen " . htmlspecialchars($_GET['delete']) . " eliminada.</p>";
        } else {
            echo "<p style='color: #ff6b6b;'>Error: la imagen no existe.</p>";
        }
    }

    // Procesar la subida de archivos si se envía el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $extension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
        if (($_FILES["file"]["size"] < MAXSIZE) &&
            in_array($_FILES["file"]["type"], $allowedFormat) &&
            in_array($extension, $allowedExts)
        ) {
            if ($_FILES["file"]["error"] > 0) {
                echo "Código de error: " . $_FILES["file"]["error"] . "<br/>";
            } else {
                $filename = uniqid() . '.' . $extension;
                if (!file_exists(DIRUPLOAD)) {
                    mkdir(DIRUPLOAD, 0777, true);
                }
                if (move_uploaded_file($_FILES["file"]["tmp_name"], DIRUPLOAD . $filename)) {
                    echo "<p style='color: #28a745;'>Archivo guardado correctamente en: " . DIRUPLOAD . $filename . "</p>";
                } else {
                    echo "<p style='color: #ff6b6b;'>Error: No se pudo mover el archivo a la carpeta 'upload/'.</p>";
                }
            }
        } else {
            echo "<p style='color: #ff6b6b;'>Archivo inválido: el tipo MIME es " . $_FILES["file"]["type"] . " y la extensión es " . $extension . "</p>";
        }
    }

    // Mostrar imágenes ya subidas con enlace de eliminación
    echo "<div class='gallery'><h2>Imágenes Subidas:</h2>";
    $images = glob(DIRUPLOAD . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
    if ($images) {
        foreach ($images as $image) {
            $filename = basename($image);
            $relative_path = DIRUPLOAD . $filename;
            echo "<div class='gallery-item'>";
            echo "<img src=\"$relative_path\" alt=\"Imagen subida\"><br>";
            echo "<a href=\"?delete=" . urlencode($filename) . "\" class=\"delete-link\">Eliminar</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No hay imágenes subidas.</p>";
    }
    echo "</div>";
    ?>
</body>

</html>
