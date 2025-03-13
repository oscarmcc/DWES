<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/setproyecto.css">
    <title>Añadir proyectos</title>
</head>
<body>
<header>
        <h1>Añadir Proyecto</h1>
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
    <form method="post" enctype="multipart/form-data">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo">
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion">
        <label for="tecnologias">Tecnologias</label>
        <input type="text" name="tecnologias" id="tecnologias">
        <label for="logo">Logo</label>
        <input type="file" name="logo" id="logo">
        <input type="submit" value="Añadir" id="submit">
    </form>
    <?php
    if(!empty($data['error'])){
        echo '<p>'.$data['error'].'</p>';
    }
    ?>
    </main>
</body>
</html>