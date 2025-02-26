<?php

// Cargar el autoloader de Composer
require_once '../../vendor/autoload.php';

// Cargar el archivo de configuración de la aplicación
require_once '../../bootstrap.php';

// Importar el modelo Blog
use App\Models\Blog;

// Obtener todos los registros de la tabla 'blog'
$blogs = Blog::all();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Blogs</title>
</head>
<body>
    <h1>Lista de Blogs</h1>
    <ul>
        <?php foreach ($blogs as $blog): ?>
            <li>
                <h2><?php echo htmlspecialchars($blog->title); ?></h2>
                <p><?php echo htmlspecialchars($blog->author); ?></p>
                <p><?php echo htmlspecialchars($blog->blog); ?></p>
                <p><?php echo htmlspecialchars($blog->created_at); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>