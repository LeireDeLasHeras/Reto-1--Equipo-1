<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutoriales</title>
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/comunes_style.css">
</head>

<body>
    <?php $tipo = $_GET['tipo'] ?>
    <div class="container">
        <div class="main-content">
            <div class="content-left">
                <?php if ($dataToView['data']['usuario']['idUsuario'] == $_SESSION['user_data']['idUsuario']): ?>
                    <h1>Mis Publicaciones</h1>
                <?php else: ?>
                    <h1>Publicaciones de <?php echo htmlspecialchars($dataToView['data']['usuario']['nickname']); ?></h1>
                <?php endif; ?>
                <hr>

                <?php if ($tipo == 'todas' || $tipo == 'preguntas'): ?>
                    <h2>Preguntas</h2>
                    <?php if (empty($dataToView['data']['preguntas'])): ?>
                        <p>No hay preguntas publicadas.</p>
                    <?php else: ?>
                        <ul>
                            <?php foreach ($dataToView['data']['preguntas'] as $pregunta): ?>
                                <li>
                                    <a href="index.php?controller=pregunta&action=view&id=<?php echo $pregunta['idPregunta']; ?>">
                                        <?php echo $pregunta['titulo']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($tipo == 'todas' || $tipo == 'tutoriales'): ?>
                    <h2>Tutoriales</h2>
                    <?php if (empty($dataToView['data']['tutoriales'])): ?>
                        <p>No has publicado ningún tutorial.</p>
                    <?php else: ?>
                        <ul>
                            <?php foreach ($dataToView['data']['tutoriales'] as $tutorial): ?>
                                <li><a href="index.php?controller=pregunta&action=view&id=<?php echo $pregunta['idPregunta']; ?>">
                                        <?php echo $tutorial['titulo']; ?>
                                    </a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($tipo == 'todas' || $tipo == 'guias'): ?>
                    <h2>Guias</h2>
                    <?php if (empty($dataToView['data']['guias'])): ?>
                        <p>No has publicado ninguna guía.</p>
                    <?php else: ?>
                        <ul>
                            <?php foreach ($dataToView['data']['guias'] as $guia): ?>
                                <li> <a href="index.php?controller=pregunta&action=view&id=<?php echo $pregunta['idPregunta']; ?>">
                                        <?php echo $guia['titulo']; ?>
                                    </a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="sidebar">
                <h3>Tipos</h3>
                <hr>
                <div class="topics">
                    <p><a href="index.php?controller=user&action=publicaciones&tipo=todas" class="tipo">Todos</a></p>
                    <p><a href="index.php?controller=user&action=publicaciones&tipo=preguntas" class="tipo">Preguntas</a></p>
                    <p><a href="index.php?controller=user&action=publicaciones&tipo=tutoriales" class="tipo">Tutoriales</a></p>
                    <p><a href="index.php?controller=user&action=publicaciones&tipo=guias" class="tipo">Guias</a></p>
                </div>
            </div>
        </div>
    </div>
</body>