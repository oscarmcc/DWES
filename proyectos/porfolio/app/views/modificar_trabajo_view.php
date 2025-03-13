<?php
// var_dump($data['trabajo']['logros']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/modificartrabajo.css">
    <title>Modificar Trabajo</title>
</head>
<body>
<header>
        <h1>Modificar Trabajo</h1>
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
    <h2>Modificar Trabajo</h2>
    <form action="" method="post">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($data['trabajo']['titulo']); ?>">
        <br>
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion" value="<?php echo htmlspecialchars($data['trabajo']['descripcion']); ?>">
        <br>
        <label for="fecha_inicio">Fecha de Inicio</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" value="<?php echo htmlspecialchars($data['trabajo']['fecha_inicio']); ?>">
        <br>
        <label for="fecha_fin">Fecha de Fin</label>
        <input type="date" name="fecha_fin" id="fecha_fin" value="<?php echo htmlspecialchars($data['trabajo']['fecha_final']); ?>">
        <br>
        <label for="logros">Logros</label>
        <input type="text" name="logros" id="logros" value="<?php echo htmlspecialchars($data['trabajo']['logros']); ?>">
        <input type="submit" name="modificar" id="modificar" value="Modificar">
    </form>
    </main>
</body>
</html>