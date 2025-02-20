<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/registro.css">
    <title>Registro</title>
</head>
<body>
    <header>
        <h1>Registro</h1>
        <nav>
            <ul>
                <li><a href="/">Principal</a></li>
                <li><a href="/login/">Login</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <h2>Formulario</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" placeholder="Nombre">
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" placeholder="Apellidos">
        <label for="foto">Foto</label>
        <input type="file" name="foto" placeholder="Foto">
        <label for="categoria_profesional">Categoria Profesional</label>
        <input type="text" name="categoria_profesional" placeholder="Categoria Profesional">
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Email">
        <label for="resumen_perfil">Resumen Perfil</label>
        <input type="text" name="resumen_perfil" placeholder="Resumen Perfil">
        <label for="passwd">Contraseña</label>
        <input type="password" name="passwd" placeholder="Contraseña">
        <label for="passwdConfirmation">Repite la Contraseña</label>
        <input type="password" name="passwdConfirmation" placeholder="Repite la Contraseña">
        <button type="submit" name="registro" id="registro" value="registro">Registrarse</button>
    </form>
    <?php

// Si hay un error en el registro lo mostramos
if (isset($data['error'])) {
    echo "<p>".$data['error'] . "</p>";
}
?>
    </main>
</body>
</html>