<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="nombre" placeholder="Nombre">
        <input type="text" name="apellidos" placeholder="Apellidos">
        <input type="file" name="foto" placeholder="Foto">
        <input type="text" name="categoria_profesional" placeholder="Categoria Profesional">
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="resumen_perfil" placeholder="Resumen Perfil">
        <input type="password" name="passwd" placeholder="Contraseña">
        <input type="password" name="passwdConfirmation" placeholder="Repite la Contraseña">
        <button type="submit" name="registro" value="registro">Registrarse</button>
        <button><a href="/login/">Login</a></button>
    </form>
</body>
</html>

<?php

// Si hay un error en el registro lo mostramos
if (isset($data['error'])) {
    echo $data['error'];
}
?>