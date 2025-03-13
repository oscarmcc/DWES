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
            <button><a href="/perfil/">Ver perfil</a></button>
            <button><a href="/eliminarusuario/">Eliminar Usuario</a></button>
            <button><a href="/examen/">Realizar examen</a></button>
        <?php endif; ?>
    </nav>

    <h1>Lista de usuarios</h1>
    <?php if (isset($data['error'])): ?>
        <p><?php echo $data['error']; ?></p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo electrónico</th>
                    <th>Resumen de perfil</th>
                    <th>Foto</th>
                    <th>Notas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['usuarios'] as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario['nombre']; ?></td>
                        <td><?php echo $usuario['apellidos']; ?></td>
                        <td><?php echo $usuario['email']; ?></td>
                        <td><?php echo $usuario['resumen_perfil']; ?></td>
                        <td><img src="./uploads/<?php echo $usuario['foto']; ?>" alt="Foto de perfil"></td>
                        <td>
                            <ul>
                                <?php foreach ($usuario['notas'] as $nota): ?>
                                    <li><?php echo $nota['nota'];?></li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>