<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guia</title>
    <link rel="icon" href="../Media/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/comunes_style.css">
</head>
<body>
    <div class="container">
        <div class="main-content">
            <div class="content-left">
                <h1><?php echo $dataToView ["data"] ["titulo"]; ?></h1>
                <p><a href="index.php?controller=user&action=publicaciones&tipo=todas&idUsuario=<?php echo $dataToView["data"]["idUsuario"]; ?>">
                    <?php echo $dataToView["data"]["nickname"]; ?>
                </a></p>
                <p><?php echo $dataToView ["data"] ["fecha"]; ?></p>
                <br>
                <p style="text-align: justify;"><?php echo $dataToView ["data"] ["descripcion"]; ?></p>
                <a href="<?php echo $dataToView ["data"] ["fichero"]; ?>" target="_blank">
                    <button class="download-button">Descargar</button>
                </a>
            </div>
        </div>
    </div>
</body>