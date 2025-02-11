<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador</title>
</head>
<body>
    <form method="get">
        <input type="text" name="nombre" placeholder="Nombre">
        <button type="submit" name="buscar" value="buscar">Buscar</button>
    </form>
</body>
</html>

<?php

// var_dump($data);
// comprobamos si hay un error en la busqueda y si no mostramos los datos de los usuarios ya que hemos pasado el array $data a la vista
if (isset($data['error'])) {
    echo $data['error'];
} else {
    if (isset($data['usuarios']) && count($data['usuarios']) > 0) {
        foreach ($data['usuarios'] as $usuario) {
            if ($usuario['visible'] == 1) {
                echo '<img src="./upload/' . $usuario['foto'] . '" alt="foto">';
                echo 'ID: ' . $usuario['id'] . '<br>';
                echo 'Nombre: ' . $usuario['nombre'] . '<br>';
                echo 'Apellidos: ' . $usuario['apellidos'] . '<br>';
                echo 'Email: ' . $usuario['email'] . '<br>';
                echo 'Categoría Profesional: ' . $usuario['categoria_profesional'] . '<br>';
                echo 'Resumen Perfil: ' . $usuario['resumen_perfil'] . '<br>';

                echo '<button><a href="/verperfil/'.$usuario['id'].'">Ver Perfil</a></button>';
                echo '<hr>';
            }
        }
    } else {
        echo 'No se encontraron usuarios.';
    }
}
?>
