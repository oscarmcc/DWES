<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/modificarproyecto.css">
    <title>Modificar Proyecto</title>
</head>
<body>
<header>
        <h1>Modificar Proyecto</h1>
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
    <h2>Modificar Proyecto</h2>
    <form action="" method="post">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($data['proyecto']['titulo']); ?>">
        <br>
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion" value="<?php echo htmlspecialchars($data['proyecto']['descripcion']); ?>">
        <br>
        <label for="tecnologias">Tecnologías</label>
        <input type="text" name="tecnologias" id="tecnologias" value="<?php echo htmlspecialchars($data['proyecto']['tecnologias']); ?>">
        <input type="submit" name="modificar" id="modificar" value="Modificar">
    </form>
    </main>
</body>
</html>