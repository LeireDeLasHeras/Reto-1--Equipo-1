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
                <div class="search-bar">
                    <img src="assets/img/logo_buscar.png" alt="Search Icon" class="search-icon">
                    <input type="text" placeholder="Buscar...">
                    <select class="order-button" name="orden" id="orden">
                        <option value="recientes">Más recientes</option>
                        <option value="antiguas">Más antiguas</option>
                        <option value="populares">Más populares</option>
                    </select>
                </div>

                <?php if(empty($dataToView["data"])): ?>
                    <p>Actualmente no hay preguntas</p>
                <?php else: ?>
                    <?php foreach($dataToView["data"] as $pregunta): ?>
                        <div class="post">
                            <h3 class="title"><?php echo $pregunta["titulo"]; ?>
                                <button class="bookmark">
                                    <img src="assets/img/logo_guardar_l.png" alt="Icono Bookmark">
                                </button>
                            </h3>
                            <p><?php echo $pregunta["nickname"]; ?><br><?php echo $pregunta["fecha"]; ?></p>
                            <p><?php echo $pregunta["descripcion"]; ?></p>
                            <p class="num-like">
                                <button class="boton-like">
                                    <img src="assets/img/logo_cora_l.png" alt="Icono Like">
                                </button>000
                            </p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <div class="add-post">
                    <a href="../HTML/PaginaFormulario_AnadirArchivo.html"><button class="add-icon"><img src="assets/img/logo_anadir.png" alt="Icono Añadir"></button></a>
                </div>
            </div>

            <div class="sidebar">
                <h3>Temas</h3>
                <hr>    
                <div class="topics">
                    <p><a href="#" class="tema">Tema1</a></p>
                    <p><a href="#" class="tema">Tema2</a></p>
                    <p><a href="#" class="tema">Tema3</a></p>
                    <p><a href="#" class="tema">Tema4</a></p>
                    <p><a href="#" class="tema">Tema5</a></p>
                </div>
            </div>
        </div>
    </div>
</body>