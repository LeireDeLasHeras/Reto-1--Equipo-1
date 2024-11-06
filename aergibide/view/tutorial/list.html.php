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
                <?php if(empty($dataToView["data"])): ?>
                    <p style="color: white;">Aún no hay tutoriales de este tema</p>
                <?php else: ?>
                    <?php foreach($dataToView["data"] as $tutorial): ?>
                        <div class="post">
                            <h3 class="title">
                                <a style="text-decoration: none; color: white; transition: color 0.2s;" onmouseover="this.style.color='#63D471'" onmouseout="this.style.color='white'" href="index.php?controller=tutorial&action=view&id=<?php echo $tutorial['idTutorial']; ?>">
                                    <?php echo $tutorial["titulo"]; ?>
                                </a>


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

                            <p><iframe width="420" height="235" src="https://www.youtube.com/embed/<?php echo $tutorial["enlace"]; ?>"
                                title="YouTube video player" frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></p>
                            <p class="num-like">
                                <button class="boton-like">
                                    <img src="assets/img/logo_cora_l.png" alt="Icono Like">
                                </button>000
                            </p>
                            <hr style="width: 90%;">
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
                </div>
                <h3>Ordenar</h3>
                <hr>
                <div class="topics">
                    <p><a href="index.php?controller=tutorial&action=list&tema=MasRecientes" class="tema">Más recientes</a></p>
                    <p><a href="index.php?controller=tutorial&action=list&tema=MasAntiguos" class="tema">Más antiguos</a></p>
                    <p><a href="index.php?controller=tutorial&action=list&tema=MasPopulares" class="tema">Más populares</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
