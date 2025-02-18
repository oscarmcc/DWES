<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="post">
        <input type="text" name="email" placeholder="Email" value="">
        <input type="password" name="passwd" placeholder="Contraseña" value="">
        <button type="submit" name="login" value="login">Login</button>
        <button><a href="/">Volver</a></button>
    </form>
</body>
</html>

<?php
// var_dump($data);
// Si hay un error en el login lo mostramos
if (isset($data['error'])) {
    echo $data['error'];
}
?>

