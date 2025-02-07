<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Trabajos</title>
</head>
<body>
    <h1></h1>Añadir Trabajos</h1>
    <button><a href="/perfil/">Mi Perfil</a></button>
    <button><a href="/logout/">Logout</a></button>
    <button><a href="/">Principal</a></button>
    <button><a href="/eliminar/">Eliminar Perfil</a></button>
    <br>
    <form action="" method="post">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo" value="">
        <br>
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion" value="">
        <br>
        <label for="fecha_inicio">Fecha Inicio</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" value="">
        <br>
        <label for="fecha_final">Fecha Fin</label>
        <input type="date" name="fecha_final" id="fecha_fin" value="">
        <br>
        <label for="logros">Logros</label>
        <input type="text" name="logros" id="logros" value="">
        <br>
        <input type="submit" value="Añadir">
    </form>
    <?php
    if(isset($data['error'])){
        echo $data['error'];
    }
    ?>
</body>
</html>