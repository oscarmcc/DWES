<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/setskill.css">
    <title>Añadir Skills</title>
</head>
<body>
<header>
        <h1>Añadir Skill</h1>
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
        
        <input type="submit" value="Añadir" id="submit">
    </form>
    <?php
    if(isset($data['error'])){
        echo $data['error'];
    }
    ?>
    </main>
</body>
</html>