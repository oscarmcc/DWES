<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/settrabajo.css">
    <title>Añadir Trabajos</title>
</head>
<body>
    <header>
    <h1>Añadir Trabajos</h1>
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
        <div>
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo" value="">
        </div>
        <div>
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion" value="">
        </div>
        <div>
        <label for="fecha_inicio">Fecha Inicio</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" value="">
        </div>
        <div>
        <label for="fecha_final">Fecha Fin</label>
        <input type="date" name="fecha_final" id="fecha_fin" value="">
        </div>
        <div>
        <label for="logros">Logros</label>
        <input type="text" name="logros" id="logros" value="">
        </div>
        <input type="submit" value="Añadir" id="submit">
    </form>
    <?php
    if(isset($data['error'])){
        echo '<p>'.$data['error'].'</p>';
    }
    ?>
    </main>
</body>
</html>