<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Redes Sociales</title>
</head>
<body>
<button><a href="/perfil/">Volver a Mi Perfil</a></button>
    <form method="post">
        <label for="redesnombre">Nombre</label>
        <input type="text" name="redesnombres" id="redesnombre">
        <label for="redeslinks">URL</label>
        <input type="text" name="redeslinks" id="redeslinks">
        <input type="submit" value="Añadir">
    </form>
</body>
</html>

<?php

if(!empty($data['error'])){
    echo $data['error'];
}
?>