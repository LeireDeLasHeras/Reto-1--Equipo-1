<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutoriales</title>
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/comunes_style.css">
</head>
<body>
    <?php $tema = $_GET['tema'] ?>
    <div class="container">
        <div class="main-content">
            <div class="content-left">
                <h1>Publicaciones guardadas></h1>
                <hr>
                <?php if ($tema == 'todas' || $tema == 'preguntas'): ?>
                    <h2>Preguntas</h2>
                    <?php if (empty($dataToView['data']['preguntas'])): ?>
                        <p>No has publicado ninguna pregunta.</p>
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

                <?php if ($tema == 'todas' || $tema == 'tutoriales'): ?>
                    <h2>Tutoriales</h2>
                    <?php if (empty($dataToView['data']['tutoriales'])): ?>
                        <p>No has publicado ningún tutorial.</p>
                    <?php else: ?>
                        <ul>
                            <?php foreach ($dataToView['data']['tutoriales'] as $tutorial): ?>
                                <li><?php echo $tutorial['titulo']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($tema == 'todas' || $tema == 'guias'): ?>
                    <h2>Guias</h2>
                    <?php if (empty($dataToView['data']['guias'])): ?>
                        <p>No has publicado ninguna guía.</p>
                    <?php else: ?>
                        <ul>
                            <?php foreach ($dataToView['data']['guias'] as $guia): ?>
                                <li><?php echo $guia['titulo']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="sidebar">
                <h3>Tipos</h3>
                <hr>    
                <div class="topics">
                    <p><a href="index.php?controller=user&action=publicaciones&tema=todas" class="tema">Todos</a></p>
                    <p><a href="index.php?controller=user&action=publicaciones&tema=preguntas" class="tema">Preguntas</a></p>
                    <p><a href="index.php?controller=user&action=publicaciones&tema=tutoriales" class="tema">Tutoriales</a></p>
                    <p><a href="index.php?controller=user&action=publicaciones&tema=guias" class="tema">Guias</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
