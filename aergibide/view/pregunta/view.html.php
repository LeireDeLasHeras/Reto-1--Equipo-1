<?php

/**
 * Vista del detalle de una pregunta
 * y sus respuestas
 * 
 * @author Oier Albeniz
 * @author Leire de las Heras
 * @author Joseba Fernandez
 * 
 * @copyright (c) 2024, Oier Albeniz, Leire de las Heras, Joseba Fernandez
 */
?>

<div class="main-content-vistaPregunta">
    <div class="content-left-vistaPregunta">

        <?php
        //Comprueba si el usuario es el creador de la pregunta o es admin para cargar el icono de borrar
        if ($dataToView["data"]["pregunta"]["idUsuario"] == $_SESSION['user_data']['idUsuario'] || $_SESSION['user_data']['tipo'] == 'admin'): ?>
            <button id="eliminar-view" class="eliminar" onclick="window.location.href='index.php?controller=pregunta&action=delete&id=<?php echo $dataToView["data"]["pregunta"]["idPregunta"]; ?>'">
                <img class="eliminar-img" src="assets/img/logo_borrar.png" alt="Icono Borrar">
                <img class="eliminar-img-hover" src="assets/img/logo_borrar_rojo.png" alt="Icono Borrar">
            </button>
        <?php endif; ?>

        <!-- Comprueba si la pregunta está guardada para cargar el icono de bookmark guardado o no -->
        <a id="bookmark-view" class="bookmark" href="#" id-data="<?php echo $dataToView["data"]["pregunta"]["idPregunta"]; ?>" isSaved="<?php echo $dataToView["data"]["isSaved"] ? 'true' : 'false'; ?>" controller-data="pregunta">
            <img src="assets/img/logo_guardar_<?php echo $dataToView["data"]["isSaved"] ? 'r' : 'l'; ?>.png" alt="Icono Bookmark guardado">
        </a>

        <!-- Comprueba si la pregunta está marcada como favorita para cargar el icono de like o no -->
        <a id="like-view" class="boton-like" href="#" id-data="<?php echo $dataToView["data"]["pregunta"]["idPregunta"]; ?>" isLiked="<?php echo $dataToView["data"]["isLiked"] ? 'true' : 'false'; ?>" controller-data="pregunta">
            <img src="assets/img/logo_cora_<?php echo $dataToView["data"]["isLiked"] ? 'r' : 'l'; ?>.png" alt="Icono Like">
        </a>

        <h1><?php echo $dataToView["data"]["pregunta"]["titulo"]; ?></h1>

        <p>
            <a href="index.php?controller=user&action=publicaciones&tipo=todas&idUsuario=<?php echo $dataToView["data"]["pregunta"]["idUsuario"]; ?>">
                <?php echo $dataToView["data"]["pregunta"]["nickname"]; ?>
            </a>
        </p>
        <p><?php echo $dataToView["data"]["pregunta"]["fecha"]; ?></p>
        <p class="descripcion-view"><?php echo $dataToView["data"]["pregunta"]["descripcion"]; ?></p>
        <div class="respuestas">
            <div class="add-respuesta">
                <a href="index.php?controller=respuesta&action=create&id=<?php echo $dataToView["data"]["pregunta"]["idPregunta"]; ?>">
                    <button>
                        Añadir Respuesta
                    </button> 
                </a>
            </div>
            <h2>Respuestas</h2>

            <?php if (empty($dataToView["data"]["respuestas"])): ?>
                <p>Alguien responderá esta pregunta pronto</p>
            <?php else: ?>
                <?php foreach ($dataToView["data"]["respuestas"] as $respuesta): ?>
                    <div class="respuesta">
                        <?php
                        //Comprueba si el usuario es el creador de la respuesta o es admin para cargar el icono de borrar
                        if ($respuesta["idUsuario"] == $_SESSION['user_data']['idUsuario'] || $_SESSION['user_data']['tipo'] == 'admin' || $respuesta["idUsuario"] == $_SESSION['user_data']['idUsuario']): ?>
                            <button id="eliminar-view" class="eliminar" onclick="window.location.href='index.php?controller=respuesta&action=delete&idRespuesta=<?php echo $respuesta["idRespuesta"]; ?>&idPregunta=<?php echo $dataToView["data"]["pregunta"]["idPregunta"]; ?>'">
                                <img class="eliminar-img" src="assets/img/logo_borrar.png" alt="Icono Borrar">
                                <img class="eliminar-img-hover" src="assets/img/logo_borrar_rojo.png" alt="Icono Borrar">
                            </button>
                        <?php endif; ?>

                        <?php
                        //Comprueba si la respuesta está guardada para cargar el icono de bookmark guardado o no
                        $respuestaGuardada = in_array($respuesta["idRespuesta"], array_column($dataToView["data"]["respuestasGuardadas"], "idRespuesta"));
                        //Comprueba si la respuesta está marcada como favorita para cargar el icono de like o no
                        $respuestaFavorita = in_array($respuesta["idRespuesta"], array_column($dataToView["data"]["respuestasFavoritas"], "idRespuesta"));
                        ?>

                        <a id="bookmark-view" class="bookmark" href="#" id-data="<?php echo $respuesta["idRespuesta"]; ?>" isSaved="<?php echo $respuestaGuardada ? 'true' : 'false'; ?>" controller-data="respuesta">
                            <img src="assets/img/logo_guardar_<?php echo $respuestaGuardada ? 'r' : 'l'; ?>.png" alt="Icono Bookmark guardado">
                        </a>

                        <a id="like-view" class="boton-like" href="#" id-data="<?php echo $respuesta["idRespuesta"]; ?>" isLiked="<?php echo $respuestaFavorita ? 'true' : 'false'; ?>" controller-data="respuesta">
                            <img src="assets/img/logo_cora_<?php echo $respuestaFavorita ? 'r' : 'l'; ?>.png" alt="Icono Like">
                        </a>

                        <a href="index.php?controller=user&action=publicaciones&tipo=todas&idUsuario=<?php echo $respuesta["idUsuario"]; ?>">
                            <?php echo $respuesta["nickname"]; ?>
                        </a>
                        <p><?php echo $respuesta["fecha"]; ?></p>
                        <p class="descripcion-view"><?php echo $respuesta["descripcion"]; ?></p>

                        <?php if (!empty($respuesta["fichero"])): ?>
                            <p>
                                <a href="<?php echo htmlentities($respuesta['fichero']); ?>" download>
                                    <button class="download-button">Descargar</button>
                                </a>
                            </p>
                        <?php else: ?>
                            <p>No hay archivos asociados a esta respuesta.</p>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="assets/js/bookmark.js"></script>
<script src="assets/js/like.js"></script>