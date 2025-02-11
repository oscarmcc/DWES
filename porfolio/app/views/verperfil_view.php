<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de <?php echo htmlspecialchars($data['nombre']); ?></title>
</head>
<body>
    <header>
        <h1>Perfil de <?php echo htmlspecialchars($data['nombre']); ?></h1>
        <nav>
            <ul>
                <li><a href="/">Inicio</a></li>
                <?php echo $data['nav']; ?>
            </ul>
        </nav>
    </header>
    <section class="general">
        <h2>Información general</h2>
        <article>
            <img src="<?php echo htmlspecialchars($data['foto']); ?>" alt="Foto de perfil">
            <p>Nombre: <?php echo htmlspecialchars($data['nombre']); ?></p>
            <p>Apellidos: <?php echo htmlspecialchars($data['apellidos']); ?></p>
            <p>Email: <?php echo htmlspecialchars($data['email']); ?></p>
            <p>Categoría profesional: <?php echo htmlspecialchars($data['categoria_profesional']); ?></p>
            <p>Resumen del perfil: <?php echo htmlspecialchars($data['resumen_perfil']); ?></p>
        </article>
    </section>

    <section class="skills">
        <h2>Skills</h2>
        <?php if (!empty($data['habilidades'])): ?>
            <?php foreach ($data['habilidades'] as $index => $habilidad): ?>
                <article>
                    <p><?php echo htmlspecialchars($habilidad); ?> - <?php echo htmlspecialchars($data['categoria'][$index]); ?></p>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay habilidades disponibles.</p>
        <?php endif; ?>
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
            <p>No hay trabajos disponibles.</p>
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
            <p>No hay proyectos disponibles.</p>
        <?php endif; ?>
    </section>
</body>
</html>