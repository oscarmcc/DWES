<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Red</title>
</head>
<body>
    <header>
        <button><a href="/logout/">Logout</a></button>
        <button><a href="/">Principal</a></button>
        <h1>Modificar Red</h1>
    </header>
    <article>
        <button><a href="/perfil/">Perfil</a></button>
    </article>
    <form action="" method="post">
        <label for="nombre">Nombre de la Red Social</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($data['red']['redes_socialescol']); ?>">
        <label for="url">URL</label>
        <input type="text" name="url" id="url" value="<?php echo htmlspecialchars($data['red']['url']); ?>">
        <input type="submit" name="modificar" value="Modificar">
    </form>
</body>
</html>