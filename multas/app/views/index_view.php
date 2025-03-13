<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo Examen</title>
</head>
<body>
    <nav>
        <?php if (strlen($_SESSION['id']) == 0): ?>
            <!-- <button><a href="/registro/">Registrar</a></button> -->
            <form action="/" method="post">
                <input type="usuario" name="usuario" placeholder="Usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>

                <label for="perfil">
                    <?php
                    // Con las tres imagenes (peaton,semaforo y coche) Hago un radio button para seleccionar la imagen que se quiere
                    // La imagen que debo seleccionar me lo debe de indicar de manera aleatoria

                    $imagenes = ['peaton', 'semaforo', 'coche'];
                    $imagen = $imagenes[rand(0, 2)];

                    echo "Elegir ". $imagen;
                    echo "<img src='./uploads/peaton.png' alt='peaton'>";
                    echo "<input type='radio' name='imagen[]' value='peaton'>";
                    echo "<img src='./uploads/semaforo.png' alt='semaforo'>";
                    echo "<input type=radio name='imagen[]' value='semaforo'>";
                    echo "<img src='./uploads/coche.png' alt='coche'>";
                    echo "<input type=radio name='imagen[]' value='coche'>";

                    echo "<video width='320' height='240' controls>";
                    echo "<source src='".$data['video']."' type='video/mp4'>";
                    echo "</video>";

                    if($data['eUsuario'] != ''){
                        echo $data['eUsuario'];
                    }
                    if($data['ePassword'] != ''){
                        echo $data['ePassword'];
                    }
                    ?>
                </label>
                <input type="hidden" name="imagenrequerida" value="<?php echo $imagen?>">
                <button type="submit">Iniciar sesión</button>
            </form>
            <button><a href="/">Vista principal</a></button>
        <?php else: ?>

            <?php if($_SESSION['rol'] == 'conductor'): ?>
            <button><a href="/logout/">Cerrar sesión</a></button>
            <button><a href="/">Vista principal</a></button>
            <button><a href="/perfil/">Ver perfil</a></button>
            <button><a href="/eliminarusuario/">Eliminar Usuario</a></button>
            <?php else: ?>
                <button><a href="/logout/">Cerrar sesión</a></button>
            <button><a href="/">Vista principal</a></button>
            <button><a href="/perfilagente/">Ver perfil</a></button>
            <button><a href="/eliminarusuario/">Eliminar Usuario</a></button>

        <?php endif; ?>
        <?php endif; ?>
    </nav>

    </body>
</html>
