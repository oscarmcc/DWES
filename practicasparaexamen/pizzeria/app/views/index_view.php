<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo Examen</title>
</head>
<body>
    <nav>
        <?php if (strlen($_SESSION['id']) == 0): ?>
            <button><a href="/registro/">Registrar</a></button>
            <form action="/login/" method="post">
                <input type="email" name="email" placeholder="Correo electrónico" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Iniciar sesión</button>
            </form>
            <button><a href="/">Vista principal</a></button>
        <?php else: ?>
            <button><a href="/logout/">Cerrar sesión</a></button>
            <button><a href="/">Vista principal</a></button>
            <button><a href="/eliminarusuario/">Eliminar Usuario</a></button>
            <button><a href="/perfil/">Ver perfil</a></button>
            <button><a href="/pizzas/">Ver pizzas</a></button>
            <button><a href="/eliminarusuario/">Eliminar Usuario</a></button>
            <button><a href="/examen/">Realizar examen</a></button>
        <?php endif; ?>
    </nav>

</body>
</html>