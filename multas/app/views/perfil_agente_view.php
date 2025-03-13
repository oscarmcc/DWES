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

    <h2>Perfil de Agente</h2>
    <h3>Agente: <?php echo $data['nombre']?></h3>


    <h3>Listado de multas</h3>
    <button><a href="/addmultas/">Nueva multa</a></button>
    <table>
        <tr>
            <th>Matricula</th>
            <th>Descripcion</th>
            <th>Fecha</th>
        </tr>
        <?php foreach ($data['multas'] as $multa) : ?>
            <tr>
                <td><?php echo $multa['matricula'] ?></td>
                <td><?php echo $multa['descripcion'] ?></td>
                <td><?php echo $multa['fecha'] ?></td>
            </tr>
        <?php endforeach; ?>
        
    </table>
</body>

</html>

<?php
// var_dump($data['multas']);

?>