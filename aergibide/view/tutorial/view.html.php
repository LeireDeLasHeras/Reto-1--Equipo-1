<?php

/**
 * Vista del detalle de un tutorial
 * 
 * @author Oier Albeniz
 * @author Leire de las Heras
 * @author Joseba Fernandez
 * 
 * @copyright (c) 2024, Oier Albeniz, Leire de las Heras, Joseba Fernandez
 */
?>

<div class="main-content-vistaTutorial">
    <div class="content-left-vistaTutorial">

        <?php
        //Comprueba si el usuario es el creador de la pregunta o es admin para cargar el icono de borrar
        if ($dataToView["data"]["tutorial"]["idUsuario"] == $_SESSION['user_data']['idUsuario'] || $_SESSION['user_data']['tipo'] == 'admin'): ?>
            <button id="eliminar-view" class="eliminar" onclick="window.location.href='index.php?controller=tutorial&action=delete&id=<?php echo $dataToView["data"]["tutorial"]["idTutorial"]; ?>'">
                <img class="eliminar-img" src="assets/img/logo_borrar.png" alt="Icono Borrar">
                <img class="eliminar-img-hover" src="assets/img/logo_borrar_rojo.png" alt="Icono Borrar">
            </button>
        <?php endif; ?>
        <!-- Comprueba si el tutorial está guardado para cargar el icono de bookmark guardado o no -->
        <a id="bookmark-view" class="bookmark" href="#" id-data="<?php echo $dataToView["data"]["tutorial"]["idTutorial"]; ?>" isSaved="<?php echo $dataToView["data"]["isSaved"] ? 'true' : 'false'; ?>" controller-data="tutorial"><img src="assets/img/logo_guardar_<?php echo $dataToView["data"]["isSaved"] ? 'r' : 'l'; ?>.png" alt="Icono Bookmark guardado"></a>
                
        <!-- Comprueba si el tutorial está marcado como favorito para cargar el icono de like o no -->
        <a id="like-view" class="boton-like" href="#" id-data="<?php echo $dataToView["data"]["tutorial"]["idTutorial"]; ?>" isLiked="<?php echo $dataToView["data"]["isLiked"] ? 'true' : 'false'; ?>" controller-data="tutorial"><img src="assets/img/logo_cora_<?php echo $dataToView["data"]["isLiked"] ? 'r' : 'l'; ?>.png" alt="Icono Like"></a>

        <h1><?php echo $dataToView["data"]["tutorial"]["titulo"]; ?></h1>
        <p><a href="index.php?controller=user&action=publicaciones&tipo=todas&idUsuario=<?php echo $dataToView["data"]["tutorial"]["idUsuario"]; ?>" controller-data="user"><?php echo $dataToView["data"]["tutorial"]["nickname"]; ?></a></p>
        <p><?php echo $dataToView["data"]["tutorial"]["fecha"]; ?></p>

        <p class="descripcion-view"><?php echo $dataToView["data"]["tutorial"]["descripcion"]; ?></p>

        <p><iframe width="600" height="338" src="https://www.youtube.com/embed/<?php echo $dataToView["data"]["tutorial"]["enlace"]; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></p>
    </div>
</div>

<!-- Scripts -->
<script src="assets/js/bookmark.js"></script>
<script src="assets/js/like.js"></script>