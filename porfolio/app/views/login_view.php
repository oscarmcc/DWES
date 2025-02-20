<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>
<body>
    <header>
        <h1>Login</h1>
        <nav>
            <ul>
                <li><a href="/">Principal</a></li>
                <li><a href="/registro/">Registro</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <h2>Formulario</h2>
    <form method="post">
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="Email" value="">
        <label for="passwd">Contraseña</label>
        <input type="password" name="passwd" placeholder="Contraseña" value="">
        <button type="submit" name="login" id="login" value="login">Login</button>
    </form>
    <?php
// var_dump($data);
// Si hay un error en el login lo mostramos
if (isset($data['error'])) {
    echo "<p>".$data['error'] . "</p>";
}
?>
    </main>
</body>
</html>

