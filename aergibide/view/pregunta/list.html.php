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
                <?php if(empty($dataToView["data"]["pregunta"])): ?>
                    <p style="color: white;">Aún no hay preguntas de este tema</p>
                <?php else: ?>
                    <?php foreach($dataToView["data"]["pregunta"] as $pregunta): ?>
                        <div class="post">
                            <h3 class="title">
                                <a style="text-decoration: none; color: white; transition: color 0.2s;" onmouseover="this.style.color='#63D471'" onmouseout="this.style.color='white'" href="index.php?controller=pregunta&action=view&id=<?php echo $pregunta['idPregunta']; ?>">
                                    <?php echo $pregunta["titulo"]; ?>
                                </a>

                                <?php 
                                $saved = false;
                                foreach($dataToView["data"]["guardadas"] as $guardada): 
                                    if($guardada["idPregunta"] == $pregunta["idPregunta"]): 
                                        $saved = true;
                                        break;
                                    endif; 
                                endforeach; 
                                ?>
                                <button class="bookmark" onclick="toggleBookmark(<?php echo $pregunta['idPregunta']; ?>, <?php echo $saved ? 'true' : 'false'; ?>)">
                                    <img class="bookmark-icon" src="assets/img/logo_guardar_<?php echo $saved ? 'r' : 'l'; ?>.png" alt="Icono Bookmark guardado">
                                </button>

                                <?php if($pregunta['idUsuario'] == $_SESSION['user_data']['idUsuario']): ?>
                                    <button class="eliminar" onclick="window.location.href='index.php?controller=pregunta&action=delete&id=<?php echo $pregunta['idPregunta']; ?>'">
                                        <img class="eliminar-img" src="assets/img/logo_borrar.png" alt="Icono Borrar">
                                        <img class="eliminar-img-hover" src="assets/img/logo_borrar_rojo.png" alt="Icono Borrar">
                                    </button>
                                <?php endif; ?>
                            </h3>
                            <p><?php echo $pregunta["nickname"]; ?><br><?php echo $pregunta["fecha"]; ?></p><br>
                            <p style="text-align: justify; max-width: 90%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $pregunta["descripcion"]; ?></p>
                            <p class="num-like">
                                <button class="boton-like">
                                    <img src="assets/img/logo_cora_l.png" alt="Icono Like">
                                </button>000
                            </p>
                            <br>
                            <hr style="width: 90%;">
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <div class="add-post">
                    <a href="index.php?controller=pregunta&action=create"><button class="add-icon"><img src="assets/img/logo_anadir.png" alt="Icono Añadir"></button></a>
                </div>
            </div>

            <div class="sidebar">
                <h3>Temas</h3>
                <hr>    
                <div class="topics">
                    <p><a href="index.php?controller=pregunta&action=list" class="tema">Todos</a></p>
                    <p><a href="index.php?controller=pregunta&action=list&tema=Seguridad" class="tema">Seguridad</a></p>
                    <p><a href="index.php?controller=pregunta&action=list&tema=Aviones" class="tema">Aviones</a></p>
                    <p><a href="index.php?controller=pregunta&action=list&tema=Piezas" class="tema">Piezas</a></p>
                    <p><a href="index.php?controller=pregunta&action=list&tema=Vuelos" class="tema">Vuelos</a></p>
                    <p><a href="index.php?controller=pregunta&action=list&tema=Reparaciones" class="tema">Reparaciones</a></p>
                </div>
                <h3>Ordenar</h3>
                <hr>
                <div class="topics">
                    <p><a href="index.php?controller=pregunta&action=list&tema=MasRecientes" class="tema">Más recientes</a></p>
                    <p><a href="index.php?controller=pregunta&action=list&tema=MasAntiguos" class="tema">Más antiguos</a></p>
                    <p><a href="index.php?controller=pregunta&action=list&tema=MasPopulares" class="tema">Más populares</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bookmark.js"></script>
</body>