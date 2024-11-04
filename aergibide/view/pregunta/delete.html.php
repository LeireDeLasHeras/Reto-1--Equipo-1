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
                <h1>Eliminar pregunta</h1>
                <br>
                <p>Estas seguro que quieres eliminar la pregunta?</p>
                <br>
                <form action="index.php?controller=pregunta&action=delete&id=<?php echo $_GET["id"]; ?>" method="post">
                    <input type="submit" name="delete" value="Sí, eliminar pregunta">
                    <input type="button" name="cancel" value="No, cancelar" onclick="window.history.back()">
                </form>
            </div>
        </div>
    </div>
</body>