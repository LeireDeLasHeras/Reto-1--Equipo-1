<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas</title>
    <link rel="icon" href="../Media/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/comunes_style.css">
    <script src="assets/js/scroll.js"></script>
</head>
<body>
    <div class="container">
        <div class="main-content">
            <div class="content-left">
                <?php if (empty($dataToView["data"]["guia"])): ?>
                    <p>Actualmente no hay guías</p>
                <?php else: ?>
                    <?php foreach ($dataToView["data"]["guia"] as $guia): ?>
                        <div class="post">
                            <h3 class="title">
                                <a style="text-decoration: none; color: white; transition: color 0.2s;" 
                                   onmouseover="this.style.color='#63D471'" 
                                   onmouseout="this.style.color='white'" 
                                   href="index.php?controller=guia&action=view&id=<?php echo $guia['idGuia']; ?>">
                                    <?php echo htmlspecialchars($guia["titulo"]); ?>
                                </a>
                                
                                <?php
                                $saved = false;
                                foreach ($dataToView["data"]["guardadas"] as $guardada):
                                    if ($guardada["idGuia"] == $guia["idGuia"]):
                                        $saved = true;
                                        break;
                                    endif;
                                endforeach;
                                ?> 

                                <a class="bookmark"
                                    href="index.php?controller=guia&action=<?php echo $saved ? 'unsave' : 'save'; ?>&id=<?php echo $guia['idGuia']; ?><?php if (isset($_GET['tema'])): ?>&tema=<?php echo $_GET['tema']; ?><?php endif; ?>"
                                    onmouseover="this.querySelector('.bookmark-icon').src='assets/img/logo_guardar_r.png';"
                                    onmouseout="this.querySelector('.bookmark-icon').src='assets/img/logo_guardar_<?php echo $saved ? 'r' : 'l'; ?>.png';">

                                    <img class="bookmark-icon" src="assets/img/logo_guardar_<?php echo $saved ? 'r' : 'l'; ?>.png" alt="Icono Bookmark guardado">
                                </a>


                                <?php if($guia['idUsuario'] == $_SESSION['user_data']['idUsuario'] || $_SESSION['user_data']['tipo'] == 'admin'): ?>
                                    <button class="eliminar" onclick="window.location.href='index.php?controller=guia&action=delete&id=<?php echo $guia['idGuia']; ?>'">
                                        <img class="eliminar-img" src="assets/img/logo_borrar.png" alt="Icono Borrar">
                                        <img class="eliminar-img-hover" src="assets/img/logo_borrar_rojo.png" alt="Icono Borrar">
                                    </button>
                                <?php endif; ?>
                            </h3>
                            <p><?php echo htmlspecialchars($guia["nickname"]); ?><br><?php echo htmlspecialchars($guia["fecha"]); ?></p><br>
                            <p style="text-align: justify; max-width: 90%;"><?php echo htmlspecialchars($guia["descripcion"]); ?></p>

                            <!-- Botón para descargar el archivo directamente -->
                            <?php if (!empty($guia["fichero"])): ?>
                                <p>
                                    <a href="<?php echo htmlentities($guia['fichero']); ?>" download>
                                        <button class="download-button">Descargar</button>
                                    </a>
                                </p>
                            <?php else: ?>
                                <p>No hay archivos asociados a esta guía.</p>
                            <?php endif; ?>
                            <p class="num-like">
                                <?php
                                $liked = false;
                                foreach ($dataToView["data"]["favoritas"] as $favorita):
                                    if ($favorita["idGuia"] == $guia["idGuia"]):
                                        $liked = true;
                                        break;
                                    endif; 
                                endforeach;
                                ?>
                                <a class="boton-like"
                                    href="index.php?controller=guia&action=<?php echo $liked ? 'unlike' : 'like'; ?>&id=<?php echo $guia['idGuia']; ?><?php if (isset($_GET['tema'])): ?>&tema=<?php echo $_GET['tema']; ?><?php endif; ?>"
                                    onmouseover="this.querySelector('.like-icon').src='assets/img/logo_cora_r.png';"
                                    onmouseout="this.querySelector('.like-icon').src='assets/img/logo_cora_<?php echo $liked ? 'r' : 'l'; ?>.png';">

                                    <img class="like-icon" src="assets/img/logo_cora_<?php echo $liked ? 'r' : 'l'; ?>.png" alt="Icono Like">
                                </a>

                                <?php
                                $contadorLikes = 0;
                                foreach ($dataToView["data"]["favoritasGenerales"] as $favoritaGeneral):
                                    if ($favoritaGeneral["idGuia"] == $guia["idGuia"]):
                                        $contadorLikes++;
                                    endif;
                                endforeach;
                                ?>
                                <?php if ($contadorLikes > 0): echo $contadorLikes;
                                endif; ?>

                            </p>
                            <br>
                            <hr style="width: 90%;">
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <div class="add-post">
                    <a href="index.php?controller=guia&action=create"><button class="add-icon"><img src="assets/img/logo_anadir.png" alt="Icono Añadir"></button></a>
                </div>
            </div>

            <div class="sidebar">
                <h3>Temas</h3>
                <hr>    
                <div class="topics">
                    <p><a href="index.php?controller=guia&action=list" class="tema">Todos</a><xº/p>
                    <p><a href="index.php?controller=guia&action=list&tema=Seguridad" class="tema">Seguridad</a></p>
                    <p><a href="index.php?controller=guia&action=list&tema=Aviones" class="tema">Aviones</a></p>
                    <p><a href="index.php?controller=guia&action=list&tema=Piezas" class="tema">Piezas</a></p>
                    <p><a href="index.php?controller=guia&action=list&tema=Vuelos" class="tema">Vuelos</a></p>
                    <p><a href="index.php?controller=guia&action=list&tema=Reparaciones" class="tema">Reparaciones</a></p>
                </div>
                <h3>Ordenar</h3>
                <hr>
                <div class="topics">
                    <p><a href="index.php?controller=guia&action=list&tema=MasRecientes" class="tema">Más recientes</a></p>
                    <p><a href="index.php?controller=guia&action=list&tema=MasAntiguos" class="tema">Más antiguos</a></p>
                    <p><a href="index.php?controller=guia&action=list&tema=MasPopulares" class="tema">Más populares</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
