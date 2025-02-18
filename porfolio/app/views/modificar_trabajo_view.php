<?php
// var_dump($data['trabajo']['logros']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Trabajo</title>
</head>
<body>
    <header>
        <button><a href="/logout/">Logout</a></button>
        <button><a href="/">Principal</a></button>
        <h1>Modificar Trabajo</h1>
    </header>
    <article>
        <button><a href="/perfil/">Perfil</a></button>
    </article>
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
        <input type="submit" name="modificar" value="Modificar">
    </form>
</body>
</html>