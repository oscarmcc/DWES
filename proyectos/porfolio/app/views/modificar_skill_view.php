<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../css/modificarskill.css">
    <title>Modificar Skill</title>
</head>
<body>
<header>
        <h1>Modificar Skill</h1>
        <nav>
    <ul>
    <li><a href="/perfil/">Mi Perfil</a></li>
    <li><a href="/logout/">Logout</a></li>
    <li><a href="/">Principal</a></li>
    <li><a href="/eliminar/">Eliminar Perfil</a></li>
    </ul>
    </nav>
    </header>
    <main>
        <h2>Formulario</h2>
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
        <input type="submit" name="modificar" value="Modificar" id="modificar">
    </form>
    </main>
</body>
</html>

<?php
// var_dump($data['skill']);

// var_dump($data['categorias_skills']);
?>