<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../css/verperfil_view.css">
    <link rel="sylesheet">
    <title>Perfil de <?php echo htmlspecialchars($data['nombre']); ?></title>
</head>

<body>
    <header>
        <h1>Perfil de <?php echo htmlspecialchars($data['nombre']); ?></h1>
        <nav>
            <ul>
                <li><a href="/">Inicio</a></li>
                <?php
                if (empty($_SESSION['id'])) {
                ?>
                    <li><a href="/registro/">Registrarse</a></li>
                    <li><a href="/login/">Login</a></li>
                <?php
                } else {
                ?>
                    <li><a href="/logout/">Logout</a></li>
                    <li><a href="/perfil/">Mi Perfil</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </header>
    <section class="general">
        <h2>Información general</h2>
        <article>
            <img src="<?php echo htmlspecialchars($data['foto']); ?>" alt="Foto de perfil">
            <div>
                <p>Nombre: <?php echo htmlspecialchars($data['nombre']); ?></p>
                <p>Apellidos: <?php echo htmlspecialchars($data['apellidos']); ?></p>
                <p>Email: <?php echo htmlspecialchars($data['email']); ?></p>
                <p>Categoría profesional: <?php echo htmlspecialchars($data['categoria_profesional']); ?></p>
                <p>Resumen del perfil: <?php echo htmlspecialchars($data['resumen_perfil']); ?></p>
            </div>
        </article>
    </section>

    <section class="redes-sociales">
        <h2>Redes Sociales</h2>
        <article>
            <?php if (!empty($data['redessociales'])): ?>
                <?php foreach ($data['redessociales'] as $index => $red): ?>
                    <div>
                        <p><a href="<?php echo htmlspecialchars($data['redessocialesurl'][$index]); ?>"><?php echo htmlspecialchars($red); ?></a></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div>
                <p>No hay redes sociales disponibles.</p>
                </div>
            <?php endif; ?>
        </article>
    </section>

    <section class="skills">
        <h2>Skills</h2>
        <article>
            <?php if (!empty($data['habilidades'])): ?>
                <?php foreach ($data['habilidades'] as $index => $habilidad): ?>
                    <div>
                        <p><?php echo htmlspecialchars($habilidad); ?> - <?php echo htmlspecialchars($data['categoria'][$index]); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div>
                <p>No hay habilidades disponibles.</p>
                </div>
            <?php endif; ?>
        </article>
    </section>

    <section class="trabajos">
        <h2>Trabajos</h2>
        <?php if (!empty($data['titulotrabajo'])): ?>
            <?php foreach ($data['titulotrabajo'] as $index => $trabajo): ?>
                <article>
                    <h3><?php echo htmlspecialchars($trabajo); ?></h3>
                    <p><?php echo htmlspecialchars($data['descripciontrabajo'][$index]); ?></p>
                    <p>Fecha de inicio: <?php echo !empty($data['fecha_iniciotrabajo'][$index]) ? htmlspecialchars($data['fecha_iniciotrabajo'][$index]) : 'No hay fecha de inicio'; ?></p>
                    <p>Fecha de finalización: <?php echo !empty($data['fecha_finaltrabajo'][$index]) ? htmlspecialchars($data['fecha_finaltrabajo'][$index]) : 'No hay fecha de finalización'; ?></p>
                    <h4>Logros:</h4>
                    <?php if (!empty($data['logros'][$index])): ?>
                        <ul>
                            <?php
                            $logros = explode(',', $data['logros'][$index]);
                            foreach ($logros as $logro): ?>
                                <li><?php echo htmlspecialchars(trim($logro)); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No hay logros disponibles.</p>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <article>
            <p>No hay trabajos disponibles.</p>
            </article>
        <?php endif; ?>
    </section>

    <section class="proyectos">
        <h2>Proyectos</h2>
        <?php if (!empty($data['proyectos'])): ?>
            <?php foreach ($data['proyectos'] as $index => $proyecto): ?>
                <article>
                    <h3><?php echo htmlspecialchars($proyecto['titulo']); ?></h3>
                    <p><?php echo htmlspecialchars($proyecto['descripcion']); ?></p>
                    <h4>Tecnologías utilizadas:</h4>
                    <?php if (!empty($proyecto['tecnologias'])): ?>
                        <ul>
                            <?php
                            $tecnologias = explode(',', $proyecto['tecnologias']);
                            foreach ($tecnologias as $tecnologia): ?>
                                <li><?php echo htmlspecialchars(trim($tecnologia)); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No hay tecnologías disponibles.</p>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <article>
            <p>No hay proyectos disponibles.</p>
            </article>
        <?php endif; ?>
    </section>
</body>

</html>