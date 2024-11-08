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
                <?php if($dataToView["data"]["pregunta"]["idUsuario"] == $_SESSION['user_data']['idUsuario'] || $_SESSION['user_data']['tipo'] == 'admin'): ?>
                    <button style="float:right;" class="eliminar" onclick="window.location.href='index.php?controller=pregunta&action=delete&id=<?php echo $dataToView["data"]["pregunta"]["idPregunta"]; ?>'">
                        <img class="eliminar-img" src="assets/img/logo_borrar.png" alt="Icono Borrar">
                                        <img class="eliminar-img-hover" src="assets/img/logo_borrar_rojo.png" alt="Icono Borrar">
                                    </button>
                                <?php endif; ?>
                <a style="float: right;" class="bookmark" href="#" id-data="<?php echo $dataToView["data"]["pregunta"]["idPregunta"]; ?>" isSaved="<?php echo $dataToView["data"]["isSaved"] ? 'true' : 'false'; ?>" controller-data="pregunta"><img src="assets/img/logo_guardar_<?php echo $dataToView["data"]["isSaved"] ? 'r' : 'l'; ?>.png" alt="Icono Bookmark guardado"></a>
                <a style="float: right;" class="boton-like" href="#" id-data="<?php echo $dataToView["data"]["pregunta"]["idPregunta"]; ?>" isLiked="<?php echo $dataToView["data"]["isLiked"] ? 'true' : 'false'; ?>" controller-data="pregunta"><img src="assets/img/logo_cora_<?php echo $dataToView["data"]["isLiked"] ? 'r' : 'l'; ?>.png" alt="Icono Like"></a>

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
                            <p>
                                <p>
                                <?php if($respuesta["idUsuario"] == $_SESSION['user_data']['idUsuario'] || $_SESSION['user_data']['tipo'] == 'admin' || $respuesta["idUsuario"] == $_SESSION['user_data']['idUsuario']): ?>
                                <button style="float:right;" class="eliminar" onclick="window.location.href='index.php?controller=respuesta&action=delete&idRespuesta=<?php echo $respuesta["idRespuesta"]; ?>&idPregunta=<?php echo $dataToView["data"]["pregunta"]["idPregunta"]; ?>'">
                                    <img class="eliminar-img" src="assets/img/logo_borrar.png" alt="Icono Borrar">
                                    <img class="eliminar-img-hover" src="assets/img/logo_borrar_rojo.png" alt="Icono Borrar">
                                </button>
                                <?php endif; ?> 

                                <?php
                                $respuestaGuardada = false;
                                foreach($dataToView["data"]["respuestasGuardadas"] as $respuestaGuardada):
                                    if($respuesta["idRespuesta"] == $respuestaGuardada["idRespuesta"]):
                                        $respuestaGuardada = true;
                                    endif;
                                endforeach;
                                ?>

                                <a style="float: right;" class="bookmark" href="#" id-data="<?php echo $respuesta["idRespuesta"]; ?>" isSaved="<?php echo $respuestaGuardada ? 'true' : 'false'; ?>" controller-data="respuesta"><img src="assets/img/logo_guardar_<?php echo $respuestaGuardada ? 'r' : 'l'; ?>.png" alt="Icono Bookmark guardado"></a>

                                <?php
                                $respuestaFavorita = false;
                                foreach($dataToView["data"]["respuestasFavoritas"] as $respuestaFavorita):
                                    if($respuesta["idRespuesta"] == $respuestaFavorita["idRespuesta"]):
                                        $respuestaFavorita = true;
                                    endif;
                                endforeach;
                                ?>

                                <a style="float: right;" class="boton-like" href="#" id-data="<?php echo $respuesta["idRespuesta"]; ?>" isLiked="<?php echo $respuestaFavorita ? 'true' : 'false'; ?>" controller-data="respuesta"><img src="assets/img/logo_cora_<?php echo $respuestaFavorita ? 'r' : 'l'; ?>.png" alt="Icono Like"></a>

                                <a href="index.php?controller=user&action=publicaciones&tipo=todas&idUsuario=<?php echo $respuesta["idUsuario"]; ?>">
                                    <?php echo $respuesta["nickname"]; ?>
                                </a>
                                </p>
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
                            </p>
                            <br><hr style="border: 1px solid rgba(255, 255, 255, 0.1);">
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
    <script src="assets/js/bookmark.js"></script>
    <script src="assets/js/like.js"></script>
</body>