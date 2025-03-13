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
            <button><a href="/perfilagente/">Ver perfil</a></button>
            <button><a href="/eliminarusuario/">Eliminar Usuario</a></button>
    </nav>

    <h2>Añadir Multa</h2>

    <h3>Agente: <?php echo $data['nombreagente']?></h3>

    <form action="" method="post">
        <label for="matricula">Matricula</label>
        <input type="text" name="matricula" required>
        <label for="conductor">Conductor</label>
        <select name="conductor" required>
            <?php foreach ($data['conductores'] as $conductor) : ?>
                <option value="<?php echo $conductor['id'] ?>"><?php echo $conductor['nombre'] ?></option>
            <?php endforeach; ?>
        </select>
        <label for="tipo">Tipo</label>
        <input type="radio" name="tipo" value="1" required>Leve
        <input type="radio" name="tipo" value="2" required>Grave
        <input type="radio" name="tipo" value="3" required>Muy grave
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" required>
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" required>
        <button type="submit">Añadir multa</button>
    </form>
</body>
</html>

<?php
if($data['eMatricula'] != ''){
    echo $data['eMatricula'];
}

if($data['eConductor'] != ''){
    echo $data['eConductor'];
}

if($data['eTipoSancion'] != ''){
    echo $data['eTipoSancion'];
}

if($data['eDescripcion'] != ''){
    echo $data['eDescripcion'];
}

if($data['eFecha'] != ''){
    echo $data['eFecha'];
}

?>