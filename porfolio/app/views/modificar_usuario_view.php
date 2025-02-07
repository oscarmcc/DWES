<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Perfil</title>
</head>
<body>
    <h1>Modificar Perfil</h1>
    <button><a href="/perfil/">Volver a Mi Perfil</a></button>
    <button><a href="/logout/">Logout</a></button>
    <form method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $data['usuario']['nombre']; ?>">
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" value="<?php echo $data['usuario']['apellidos']; ?>">
        <label for="foto">Foto</label>
        <input type="file" name="foto" id="foto">
        <label for="categoria_profesional">Categoria Profesional</label>
        <input type="text" name="categoria_profesional" id="categoria_profesional" value="<?php echo $data['usuario']['categoria_profesional']; ?>">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo $data['usuario']['email']; ?>">
        <label for="resumen_perfil">Resumen Perfil</label>
        <textarea name="resumen_perfil" id="resumen_perfil"><?php echo $data['usuario']['resumen_perfil']; ?></textarea>
        <input type="submit" name="modificar" value="Modificar">
    </form>
</body>
</html>
