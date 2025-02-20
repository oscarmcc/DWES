<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../css/index_view.css">
    <title>Buscador de Usuarios</title>
</head>
<body>
    <header>
        <h1>Buscador de Usuarios</h1>
        <nav>
            <ul>
                <li><a href="/">Inicio</a></li>
                <?php if (empty($_SESSION['id'])): ?>
                    <li><a href="/registro/">Registrarse</a></li>
                    <li><a href="/login/">Login</a></li>
                <?php else: ?>
                    <li><a href="/logout/">Logout</a></li>
                    <li><a href="/perfil/">Mi Perfil</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <form method="get" class="search-form">
            <input type="text" name="nombre" placeholder="Buscar usuario por nombre">
            <button type="submit">Buscar</button>
        </form>

        <?php if (isset($data['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($data['error']); ?></p>
        <?php else: ?>
            <div class="usuarios-grid">
                <?php foreach ($data['usuarios'] as $usuario):
                    if ($usuario['visible'] == 1): ?>
                        <div class="usuario">
                            <img src="./upload/<?php echo htmlspecialchars($usuario['foto']); ?>" alt="Foto de <?php echo htmlspecialchars($usuario['nombre']); ?>">
                            <div class="usuario-info">
                                <p><?php echo htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellidos']); ?></p>
                                <p><?php echo htmlspecialchars($usuario['email']); ?></p>
                                <p><?php echo htmlspecialchars($usuario['categoria_profesional']); ?></p>
                                <p><?php echo htmlspecialchars($usuario['resumen_perfil']); ?></p>
                            </div>
                            <button>
                                <a href="/verperfil/<?php echo htmlspecialchars($usuario['id']); ?>">Ver Perfil</a>
                            </button>
                        </div>
                    <?php endif;
                endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>