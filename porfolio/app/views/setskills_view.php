<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Skills</title>
</head>
<body>
    <h1>Añadir Skills</h1>
    <button><a href="/perfil/">Mi Perfil</a></button>
    <button><a href="/logout/">Logout</a></button>
    <button><a href="/">Principal</a></button>
    <button><a href="/eliminar/">Eliminar Perfil</a></button>
    <br>
    <form action="" method="post">
        <label for="habilidades">Habilidades</label>
        <input type="text" name="habilidades" id="habilidades" value="">
        <br>
        
        <?php
        if(isset($data['categorias_skills'])){
            foreach ($data['categorias_skills'] as $categoria) {
                echo '<input type="radio" name="categorias_skill_categoria" value="' . $categoria['categoria'] . '">' . $categoria['categoria'] . '<br>';
            }
        }
        ?>
        
        <input type="submit" value="Añadir">
    </form>
    <?php
    if(isset($data['error'])){
        echo $data['error'];
    }
    ?>
</body>
</html>