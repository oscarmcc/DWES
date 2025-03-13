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

    <h2>Pago de Multa</h2>
    <?php
    foreach($data['multas'] as $multa){
        echo "<p>Id: ".$multa['id']."</p>";
        echo "<p>Matricula: ".$multa['matricula']."</p>";
        echo "<p>Descripcion: ".$multa['descripcion']."</p>";
        echo "<p>Tipo de Sancion".$multa['id_tipo_sanciones']."</p>";
        echo "<p>Descripcion: ".$multa['descripcion']."</p>";
        echo "<p>Fecha: ".$multa['fecha']."</p>";
        echo "<p>Estado: ".$multa['estado']."</p>";
        echo "<p>Importe: ".$multa['importe']."</p>";
        echo "<p>Descuento: ".$multa['descuento']."</p>";
    }

?>
<form method="post" action="">
    <button type="submit">Pagar</button>
</form>
</body>
</html>