<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas</title>
    <link rel="icon" href="../Media/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/comunes_style.css">
</head>
<body>
    <div class="container">
        <div class="main-content">
            <div class="content-left-vistaPregunta">
                <h1><?php echo $dataToView["data"]["pregunta"]["titulo"]; ?></h1>
                <p><a href="index.php?controller=user&action=publicaciones&tipo=todas&idUsuario=<?php echo $dataToView["data"]["pregunta"]["idUsuario"]; ?>">
                    <?php echo $dataToView["data"]["pregunta"]["nickname"]; ?>
                </a></p>
                <p><?php echo $dataToView["data"]["pregunta"]["fecha"]; ?></p>
                <p style="text-align: justify;"><?php echo $dataToView["data"]["pregunta"]["descripcion"]; ?></p>
                <div class="respuestas">
                        <h2>Respuestas</h2>
                        <?php if(empty($dataToView["data"]["respuestas"])): ?>
                            <p>Alguien responderá esta pregunta pronto</p>
                            <?php else: ?>
                            <?php foreach($dataToView["data"]["respuestas"] as $respuesta): ?>
                                <p><a href="index.php?controller=user&action=publicaciones&tipo=todas&idUsuario=<?php echo $respuesta["idUsuario"]; ?>">
                        <?php echo $respuesta["nickname"]; ?>
                    </a></p>
                                <p><?php echo $respuesta["fecha"]; ?></p>
                                <p><?php echo $respuesta["descripcion"]; ?></p>
                                <?php if (!empty($respuesta["fichero"])): ?>
                                <p>
                                    <a href="<?php echo htmlentities($respuesta['fichero']); ?>" download>
                                        <button class="download-button">Descargar</button>
                                    </a>
                                </p>
                                <?php else: ?>
                                    <p>No hay archivos asociados a esta respuesta.</p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <div class="add-respuesta">
                        <a href="index.php?controller=respuesta&action=create&id=<?php echo $dataToView["data"]["pregunta"]["idPregunta"]; ?>">
                            <button>
                                Añadir Respuesta
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>