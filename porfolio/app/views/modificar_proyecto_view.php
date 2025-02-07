<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Proyecto</title>
</head>
<body>
    <header>
        <button><a href="/logout/">Logout</a></button>
        <button><a href="/">Principal</a></button>
        <h1>Modificar Proyecto</h1>
    </header>
    <article>
        <button><a href="/perfil/">Perfil</a></button>
    </article>
    <form action="" method="post">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($data['proyecto']['titulo']); ?>">
        <br>
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion" value="<?php echo htmlspecialchars($data['proyecto']['descripcion']); ?>">
        <br>
        <label for="tecnologias">Tecnologías</label>
        <input type="text" name="tecnologias" id="tecnologias" value="<?php echo htmlspecialchars($data['proyecto']['tecnologias']); ?>">
        <input type="submit" name="modificar" value="Modificar">
    </form>
</body>
</html>