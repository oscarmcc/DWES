<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir proyectos</title>
</head>
<body>
<button><a href="/perfil/">Volver a Mi Perfil</a></button>
    <form method="post" enctype="multipart/form-data">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo">
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion">
        <label for="tecnologias">Tecnologias</label>
        <input type="text" name="tecnologias" id="tecnologias">
        <label for="logo">Logo</label>
        <input type="file" name="logo" id="logo">
        <input type="submit" value="Añadir">
    </form>
    <?php
    if(!empty($data['error'])){
        echo $data['error'];
    }
    ?>
</body>
</html>