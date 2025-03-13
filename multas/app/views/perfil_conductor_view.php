<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav>
        <button><a href="/logout/">Cerrar sesión</a></button>
        <button><a href="/">Vista principal</a></button>
        <button><a href="/perfil/">Ver perfil</a></button>
        <button><a href="/eliminarusuario/">Eliminar Usuario</a></button>
    </nav>

    <h2>Listado de multas</h2>
    <table>
        <tr>
            <th>Matricula</th>
            <th>Descripcion</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Pagar</th>
        </tr>
        <?php foreach ($data['multas'] as $multa) : ?>
            <tr>
                <td><?= $multa['matricula'] ?></td>
                <td><?= $multa['descripcion'] ?></td>
                <td><?= $multa['fecha'] ?></td>
                <td><?= $multa['estado'] ?></td>
                <td><?php
                    if($multa['estado'] == 'Pendiente'){
                        echo "<a href='/pagarmultas/".$multa['id']."'>Pagar</a>";
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
</body>

</html>