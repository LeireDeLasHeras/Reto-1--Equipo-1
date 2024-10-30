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
            <div class="content-left">
                <h1><?php echo $dataToView["data"]["pregunta"]["titulo"]; ?></h1>
                <p><?php echo $dataToView["data"]["pregunta"]["nickname"]; ?></p>
                <p><?php echo $dataToView["data"]["pregunta"]["fecha"]; ?></p>
                <br>
                <p style="text-align: justify;"><?php echo $dataToView["data"]["pregunta"]["descripcion"]; ?></p>
                <br>
                <hr>
                <br>
                <div class="respuestas">
                    <h2>Respuestas</h2>
                    <br>
                    <?php if(empty($dataToView["data"]["respuestas"])): ?>
                        <p>Alguien responderá esta pregunta pronto</p>
                    <?php else: ?>
                        <?php foreach($dataToView["data"]["respuestas"] as $respuesta): ?>
                            <p><?php echo $respuesta["nickname"]; ?></p>
                            <p><?php echo $respuesta["fecha"]; ?></p>
                            <p><?php echo $respuesta["descripcion"]; ?></p>
                            <br>
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