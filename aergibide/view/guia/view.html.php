<?php

/**
 * Vista del detalle de una guia
 * 
 * @author Oier Albeniz
 * @author Leire de las Heras
 * @author Joseba Fernandez
 * 
 * @copyright (c) 2024, Oier Albeniz, Leire de las Heras, Joseba Fernandez
 */
?>

<div class="main-content-vistaGuia">
    <div class="content-left-vistaGuia">

        <?php
        //Comprueba si el usuario es el creador de la guia o es admin para cargar el icono de borrar
        if ($dataToView["data"]["guia"]["idUsuario"] == $_SESSION['user_data']['idUsuario'] || $_SESSION['user_data']['tipo'] == 'admin'): ?>
            <button id="eliminar-view" class="eliminar" onclick="window.location.href='index.php?controller=guia&action=delete&id=<?php echo $dataToView["data"]["guia"]["idGuia"]; ?>'">

                <img class="eliminar-img" src="assets/img/logo_borrar.png" alt="Icono Borrar">
                <img class="eliminar-img-hover" src="assets/img/logo_borrar_rojo.png" alt="Icono Borrar">
            </button>
        <?php endif; ?>
        <!-- Comprueba si la guia está guardada para cargar el icono de bookmark guardado o no -->
        <a id="bookmark-view" class="bookmark" href="#" id-data="<?php echo $dataToView["data"]["guia"]["idGuia"]; ?>" isSaved="<?php echo $dataToView["data"]["isSaved"] ? 'true' : 'false'; ?>" controller-data="guia"><img src="assets/img/logo_guardar_<?php echo $dataToView["data"]["isSaved"] ? 'r' : 'l'; ?>.png" alt="Icono Bookmark guardado"></a>

        <!-- Comprueba si la guia está marcada como favorita para cargar el icono de like o no -->
        <a id="like-view" class="boton-like" href="#" id-data="<?php echo $dataToView["data"]["guia"]["idGuia"]; ?>" isLiked="<?php echo $dataToView["data"]["isLiked"] ? 'true' : 'false'; ?>" controller-data="guia"><img src="assets/img/logo_cora_<?php echo $dataToView["data"]["isLiked"] ? 'r' : 'l'; ?>.png" alt="Icono Like"></a>

        <h1><?php echo $dataToView["data"]["guia"]["titulo"]; ?></h1>

        <p><a href="index.php?controller=user&action=publicaciones&tipo=todas&idUsuario=<?php echo $dataToView["data"]["guia"]["idUsuario"]; ?>">
                <?php echo $dataToView["data"]["guia"]["nickname"]; ?>
            </a></p>

        <p><?php echo $dataToView["data"]["guia"]["fecha"]; ?></p>
        <p class="descripcion-view"><?php echo $dataToView["data"]["guia"]["descripcion"]; ?></p>

        <?php if (!empty($dataToView["data"]["guia"]["fichero"])): ?>
            <a href="<?php echo $dataToView["data"]["guia"]["fichero"]; ?>" target="_blank">
                <button class="download-button-viewGuia">Descargar</button>
            </a>
        <?php else: ?>
            <p>No hay archivos asociados a esta gu&iacute;a.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Scripts -->
<script src="assets/js/bookmark.js"></script>
<script src="assets/js/like.js"></script>