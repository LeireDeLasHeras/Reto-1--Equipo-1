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
                    <p style="color: white;">Aún no hay tutoriales de este tema</p>
                <?php else: ?>
                    <?php foreach($dataToView["data"] as $tutorial): ?>
                        <div class="post">
                            <h3 class="title"><?php echo $tutorial["titulo"]; ?>
                                <button class="bookmark">
                                    <img src="assets/img/logo_guardar_l.png" alt="Icono Bookmark">
                                </button>
                                <?php if($tutorial['idUsuario'] == $_SESSION['user_data']['idUsuario']): ?>
                                    <button class="eliminar" onclick="window.location.href='index.php?controller=tutorial&action=delete&id=<?php echo $tutorial['idTutorial']; ?>'">
                                        <img class="eliminar-img" src="assets/img/logo_borrar.png" alt="Icono Borrar">
                                        <img class="eliminar-img-hover" src="assets/img/logo_borrar_rojo.png" alt="Icono Borrar">
                                    </button>
                                <?php endif; ?>
                            </h3>
                            <p><?php echo $tutorial["tema"]; ?></p>
                            <p><?php echo $tutorial["fecha"]; ?></p>
                            <p><?php echo $tutorial["nickname"]; ?></p>
                            <p><?php echo $tutorial["descripcion"]; ?></p>

                            <p><iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $tutorial["enlace"]; ?>"
                                title="YouTube video player" frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></p>
                            <p class="num-like">
                                <button class="boton-like">
                                    <img src="assets/img/logo_cora_l.png" alt="Icono Like">
                                </button>000
                            </p>

                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="add-post">
                    <a href="index.php?controller=tutorial&action=create"><button class="add-icon"><img src="assets/img/logo_anadir.png" alt="Icono Añadir"></button></a>                </div>
            </div>

            <div class="sidebar">
                <h3>Temas</h3>
                <hr>    
                <div class="topics">
                    <p><a href="index.php?controller=tutorial&action=list" class="tema">Todos</a></p>
                    <p><a href="index.php?controller=tutorial&action=list&tema=Seguridad" class="tema">Seguridad</a></p>
                    <p><a href="index.php?controller=tutorial&action=list&tema=Aviones" class="tema">Aviones</a></p>
                    <p><a href="index.php?controller=tutorial&action=list&tema=Piezas" class="tema">Piezas</a></p>
                    <p><a href="index.php?controller=tutorial&action=list&tema=Vuelos" class="tema">Vuelos</a></p>
                    <p><a href="index.php?controller=tutorial&action=list&tema=Reparaciones" class="tema">Reparaciones</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
