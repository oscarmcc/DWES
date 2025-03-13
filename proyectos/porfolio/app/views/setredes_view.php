<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/setredes.css">
    <title>Añadir Redes Sociales</title>
</head>
<body>
    <header>
        <h1>Añadir Redes Sociales</h1>
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
    <form method="post">
        <label for="redesnombre">Nombre</label>
        <input type="text" name="redesnombres" id="redesnombre">
        <label for="redeslinks">URL</label>
        <input type="text" name="redeslinks" id="redeslinks">
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
