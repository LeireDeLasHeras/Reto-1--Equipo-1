<?php

/**
 * Vista para listar los tutoriales.
 * 
 * @author Oier Albeniz
 * @author Leire de las Heras
 * @author Joseba Fernandez
 * 
 * @copyright (c) 2024, Oier Albeniz, Leire de las Heras, Joseba Fernandez
 */
?>

<div class="main-content">
    <div class="content-left">

        <?php if (empty($dataToView["data"]["tutorial"])): ?>
            <p style="color: white;">A&uacute;n no hay tutoriales de este tema</p>
        <?php else: ?>

            <?php foreach ($dataToView["data"]["tutorial"] as $tutorial): ?>
                <div class="post">
                    <h3 class="title">
                        <a href="index.php?controller=tutorial&action=view&id=<?php echo $tutorial['idTutorial']; ?>">
                            <?php echo $tutorial["titulo"]; ?>
                        </a>

                        <?php
                        //Comprueba si el tutorial está guardado para cargar el icono de bookmark guardado o no
                        $saved = false;
                        foreach ($dataToView["data"]["guardados"] as $guardado):
                            if ($guardado["idTutorial"] == $tutorial["idTutorial"]):
                                $saved = true;
                                break;
                            endif;
                        endforeach;
                        ?>

                        <a class="bookmark" href="#"
                            id-data="<?php echo $tutorial['idTutorial']; ?>"
                            isSaved="<?php echo $saved ? 'true' : 'false'; ?>"
                            controller-data="tutorial">
                            <img src="assets/img/logo_guardar_<?php echo $saved ? 'r' : 'l'; ?>.png"
                                alt="Icono Bookmark guardado">
                        </a>

                        <?php
                        //Comprueba si el usuario es el creador del tutorial o es admin para cargar el icono de borrar
                        if ($tutorial['idUsuario'] == $_SESSION['user_data']['idUsuario'] || $_SESSION['user_data']['tipo'] == 'admin'): ?>
                            <button class="eliminar"
                                onclick="window.location.href='index.php?controller=tutorial&action=delete&id=<?php echo $tutorial['idTutorial']; ?>'">
                                <img class="eliminar-img" src="assets/img/logo_borrar.png"
                                    alt="Icono Borrar">
                                <img class="eliminar-img-hover" src="assets/img/logo_borrar_rojo.png"
                                    alt="Icono Borrar">
                            </button>
                        <?php endif; ?>

                    </h3>

                    <div class="contenido-tutorial">
                        <iframe width="300" height="168" src="https://www.youtube.com/embed/<?php echo $tutorial["enlace"]; ?>"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                        <div class="details-tutorial">
                            <p><?php echo $tutorial["tema"]; ?></p>
                            <p><?php echo $tutorial["fecha"]; ?></p>
                            <p><?php echo $tutorial["nickname"]; ?></p>
                            <p><?php echo strlen($tutorial['descripcion']) > 40 ? substr($tutorial['descripcion'], 0, 40) . '...' : $tutorial['descripcion']; ?></p>
                        </div>
                    </div>

                    <p class="num-like">
                        <?php
                        //Comprueba si la pregunta está marcada como favorita para cargar el icono de like marcado o no
                        $liked = false;
                        foreach ($dataToView["data"]["favoritos"] as $favorita):
                            if ($favorita["idTutorial"] == $tutorial["idTutorial"]):
                                $liked = true;
                                break;
                            endif;
                        endforeach;
                        ?>
                        <a class="boton-like" href="#" id-data="<?php echo $tutorial['idTutorial']; ?>" isLiked="<?php echo $liked ? 'true' : 'false'; ?>" controller-data="tutorial">
                            <img class="like-icon" src="assets/img/logo_cora_<?php echo $liked ? 'r' : 'l'; ?>.png"
                                alt="Icono Like">
                        </a>
                        <span class="like-count" id="like-count-<?php echo $tutorial['idTutorial']; ?>"><?php echo $tutorial['like_count']; ?></span>

                    </p>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="add-post">
            <a href="index.php?controller=tutorial&action=create">
                <button class="add-icon">
                    <img src="assets/img/logo_anadir.png" alt="Icono Añadir">
                </button>
            </a>
        </div>

    </div>
    <div class="sidebar">
        <h3>Temas</h3>
        <div class="topics">
            <p><a href="index.php?controller=pregunta&action=list" class="tema">Todos</a></p>
            <p><a href="index.php?controller=pregunta&action=list&tema=Seguridad" class="tema">Seguridad</a></p>
            <p><a href="index.php?controller=pregunta&action=list&tema=Aviones" class="tema">Aviones</a></p>
            <p><a href="index.php?controller=pregunta&action=list&tema=Piezas" class="tema">Piezas</a></p>
            <p><a href="index.php?controller=pregunta&action=list&tema=Vuelos" class="tema">Vuelos</a></p>
            <p><a href="index.php?controller=pregunta&action=list&tema=Reparaciones" class="tema">Reparaciones</a></p>
        </div>
        <h3>Ordenar</h3>
        <div class="topics">
            <p><a href="index.php?controller=pregunta&action=list&tema=MasRecientes" class="tema">M&aacute;s recientes</a></p>
            <p><a href="index.php?controller=pregunta&action=list&tema=MasAntiguos" class="tema">M&aacute;s antiguos</a></p>
            <p><a href="index.php?controller=pregunta&action=list&tema=MasPopulares" class="tema">M&aacute;s populares</a></p>
        </div>
    </div>
</div>
<script src="assets/js/bookmark.js"></script>
<script src="assets/js/like.js"></script>