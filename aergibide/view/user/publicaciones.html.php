<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutoriales</title>
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/comunes_style.css">
</head>
<body>
    <div class="container">
        <div class="main-content">
            <div class="content-left">
                <h1>Publicaciones de <?php echo $_SESSION['user_data']['nickname']; ?></h1>
                <hr>
                <h2>Preguntas</h2>
                <?php if (empty($dataToView['preguntas'])): ?>
                    <p>No has publicado ninguna pregunta.</p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($dataToView['preguntas'] as $pregunta): ?>
                            <li><?php echo $pregunta['titulo']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <h2>Guias</h2>
                <?php if (empty($dataToView['guias'])): ?>
                    <p>No has publicado ninguna guía.</p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($dataToView['guias'] as $guia): ?>
                            <li><?php echo $guia['titulo']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <h2>Tutoriales</h2>
                <?php if (empty($dataToView['tutoriales'])): ?>
                    <p>No has publicado ningún tutorial.</p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($dataToView['tutoriales'] as $tutorial): ?>
                            <li><?php echo $tutorial['titulo']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="sidebar">
                <h3>Tipos</h3>
                <hr>    
                <div class="topics">
                    <p><a href="index.php?controller=user&action=publicaciones" class="tema">Todos</a></p>
                    <p><a href="index.php?controller=user&action=publicaciones&tema=Preguntas" class="tema">Preguntas</a></p>
                    <p><a href="index.php?controller=user&action=publicaciones&tema=Tutoriales" class="tema">Tutoriales</a></p>
                    <p><a href="index.php?controller=user&action=publicaciones&tema=Guias" class="tema">Guias</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
