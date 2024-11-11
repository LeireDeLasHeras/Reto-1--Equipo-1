<?php
/**
 * Vista para ver un tutorial.
 * 
 * @author Oier Albeniz
 * @author Leire de las Heras
 * @author Joseba Fernandez
 * 
 * @copyright (c) 2024, Oier Albeniz, Leire de las Heras, Joseba Fernandez
 */
?>

<div class="main-content">
    <div class="content-left-vistaTutorial">

        <?php if($dataToView["data"]["tutorial"]["idUsuario"] == $_SESSION['user_data']['idUsuario'] || $_SESSION['user_data']['tipo'] == 'admin'): ?>
            <button class="eliminar" onclick="window.location.href='index.php?controller=tutorial&action=delete&id=<?php echo $dataToView["data"]["tutorial"]["idTutorial"]; ?>'">
                <img class="eliminar-img" src="assets/img/logo_borrar.png" alt="Icono Borrar">
                <img class="eliminar-img-hover" src="assets/img/logo_borrar_rojo.png" alt="Icono Borrar">
            </button>
        <?php endif; ?>

        <a class="bookmark" href="#" id-data="<?php echo $dataToView["data"]["tutorial"]["idTutorial"]; ?>" isSaved="<?php echo $dataToView["data"]["isSaved"] ? 'true' : 'false'; ?>" controller-data="tutorial"><img src="assets/img/logo_guardar_<?php echo $dataToView["data"]["isSaved"] ? 'r' : 'l'; ?>.png" alt="Icono Bookmark guardado"></a>
        <a class="boton-like" href="#" id-data="<?php echo $dataToView["data"]["tutorial"]["idTutorial"]; ?>" isLiked="<?php echo $dataToView["data"]["isLiked"] ? 'true' : 'false'; ?>" controller-data="tutorial"><img src="assets/img/logo_cora_<?php echo $dataToView["data"]["isLiked"] ? 'r' : 'l'; ?>.png" alt="Icono Like"></a>
       
        <h1><?php echo $dataToView["data"]["tutorial"]["titulo"]; ?></h1>
        <p><a href="index.php?controller=user&action=publicaciones&tipo=todas&idUsuario=<?php echo $dataToView["data"]["tutorial"]["idUsuario"]; ?>" controller-data="user"><?php echo $dataToView["data"]["tutorial"]["nickname"]; ?></a></p>
        <p><?php echo $dataToView["data"]["tutorial"]["fecha"]; ?></p>
       
        <p><?php echo $dataToView["data"]["tutorial"]["descripcion"]; ?></p>
       
        <p><iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $dataToView["data"]["tutorial"]["enlace"]; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></p>
    </div>
</div>
<script src="assets/js/bookmark.js"></script>
<script src="assets/js/like.js"></script>   