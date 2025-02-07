<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Skill</title>
</head>
<body>
    <header>
        <button><a href="/logout/">Logout</a></button>
        <button><a href="/">Principal</a></button>
        <h1>Modificar Skill</h1>
    </header>
    <article>
        <button><a href="/perfil/">Perfil</a></button>
    </article>
    <form action="" method="post">
        <label for="nombre">Habilidades de la Skill</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($data['skill']['habilidades']); ?>">
        <br>
        <label for="categoria">Categoria</label>
        <br>
        <?php
        if(isset($data['categorias_skills'])){
            foreach ($data['categorias_skills'] as $categoria) {
                $checked = "";
                if($categoria['categoria'] == $data['skill']['categorias_skill_categoria']){
                    $checked = "checked";
                }
                echo '<input type="radio" name="categoria" value="' . $categoria['categoria'] . '"'.$checked.'>' . $categoria['categoria'] . '<br>';
            }
        }
        ?>
        <input type="submit" name="modificar" value="Modificar">
    </form>
</body>
</html>

<?php
// var_dump($data['skill']);

// var_dump($data['categorias_skills']);
?>