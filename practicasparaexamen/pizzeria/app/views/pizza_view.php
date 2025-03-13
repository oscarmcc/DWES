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

    <h1>Pizzas</h1>

    <form action="" method="post">
        <select name="nombre" required>
            <option value="">Seleccione una pizza</option>
            <?php ;foreach ($data['pizzasNombre'] as $pizza): ?>
                <option value="<?php echo $pizza['nombre']; ?>"><?php echo $pizza['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="verpizza">Ver pizza</button>
    </form>

    <?php if ($data['pizzas'] != ''): ?>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Ingredientes</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['pizzas'] as $pizza): ?>
                    <tr>
                        <td><?php echo $pizza['nombre']; ?></td>
                        <td><?php echo $pizza['descripcion']; ?></td>
                        <td><?php echo $pizza['ingredientes']; ?></td>
                        <td><img src="<?php echo $pizza['foto']; ?>" alt="<?php echo $pizza['nombre']; ?>"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>