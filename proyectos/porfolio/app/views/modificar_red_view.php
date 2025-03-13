<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../css/modificarred.css">
    <title>Modificar Red</title>
</head>
<body>
<header>
        <h1>Modificar Red Social</h1>
        <nav>
    <ul>
    <li><a href="/perfil/">Mi Perfil</a></li>
    <li><a href="/logout/">Logout</a></li>
    <li><a href="/">Principal</a></li>
    <li><a href="/eliminar/">Eliminar Perfil</a></li>
    </ul>
    </nav>
    </header>
    <main>
        <h2>Formulario</h2>
    <form action="" method="post">
        <label for="nombre">Nombre de la Red Social</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($data['red']['redes_socialescol']); ?>">
        <label for="url">URL</label>
        <input type="text" name="url" id="url" value="<?php echo htmlspecialchars($data['red']['url']); ?>">
        <input type="submit" name="modificar" value="Modificar" id="modificar">
    </form>
    </main>
</body>
</html>