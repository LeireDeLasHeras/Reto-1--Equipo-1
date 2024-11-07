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
            <div class="content-left-vistaTutorial">
                <h1><?php echo $dataToView["data"]["titulo"]; ?></h1>
                <p><a href="index.php?controller=user&action=publicaciones&tipo=todas&idUsuario=<?php echo $dataToView["data"]["idUsuario"]; ?>">
                    <?php echo $dataToView["data"]["nickname"]; ?>
                </a></p>
                <p><?php echo $dataToView["data"]["fecha"]; ?></p>
                <p style="text-align: justify;"><?php echo $dataToView["data"]["descripcion"]; ?></p>
                <p><iframe width="420" height="235" src="https://www.youtube.com/embed/<?php echo $dataToView["data"]["enlace"]; ?>"
                                title="YouTube video player" frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></p>
            </div>
        </div>
    </div>
</body>