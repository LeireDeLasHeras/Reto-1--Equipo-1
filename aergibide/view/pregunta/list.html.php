<?php

/**
 * Vista de la lista de preguntas.
 * 
 * @author Oier Albeniz
 * @author Leire de las Heras
 * @author Joseba Fernández
 * 
 * @copyright (c) 2024, Oier Albeniz, Leire de las Heras, Joseba Fernández
 */
?>

<div class="main-content">
    <div class="content-left">

        <?php if (empty($dataToView["data"]["pregunta"])): ?>
            <p>Actualmente no hay preguntas</p>
        <?php else: ?>

            <?php foreach ($dataToView["data"]["pregunta"] as $pregunta): ?>
                <div class="post">
                    <h3 class="title">
                        <a href="index.php?controller=pregunta&action=view&id=<?php echo $pregunta['idPregunta']; ?>">
                            <?php echo $pregunta["titulo"]; ?>
                        </a>

                        <?php
                        //Comprueba si la pregunta está guardada para cargar el icono de bookmark guardado o no
                        $saved = false;
                        foreach ($dataToView["data"]["guardadas"] as $guardada):
                            if ($guardada["idPregunta"] == $pregunta["idPregunta"]):
                                $saved = true;
                                break;
                            endif;
                        endforeach;
                        ?>

                        <a class="bookmark" href="#" id-data="<?php echo $pregunta['idPregunta']; ?>" isSaved="<?php echo $saved ? 'true' : 'false'; ?>" controller-data="pregunta">
                            <img src="assets/img/logo_guardar_<?php echo $saved ? 'r' : 'l'; ?>.png" alt="Icono Bookmark guardado">
                        </a>

                        <?php
                        //Comprueba si el usuario es el creador de la pregunta o es admin para cargar el icono de borrar
                        if ($pregunta['idUsuario'] == $_SESSION['user_data']['idUsuario'] || $_SESSION['user_data']['tipo'] == 'admin') : ?>
                            <button class="eliminar" onclick="window.location.href='index.php?controller=pregunta&action=delete&id=<?php echo $pregunta['idPregunta']; ?>'">
                                <img class="eliminar-img" src="assets/img/logo_borrar.png" alt="Icono Borrar">
                                <img class="eliminar-img-hover" src="assets/img/logo_borrar_rojo.png" alt="Icono Borrar">
                            </button>
                        <?php endif; ?>

                    </h3>
                    <p><?php echo $pregunta["nickname"]; ?><br><?php echo $pregunta["fecha"]; ?></p><br>
                    <p><?php echo strlen($pregunta['descripcion']) > 75 ? substr($pregunta['descripcion'], 0, 75) . '...' : $pregunta['descripcion']; ?></p>

                    <p class="num-like">
                        <?php
                        //Comprueba si la pregunta está marcada como favorita para cargar el icono de like marcado o no
                        $liked = false;
                        foreach ($dataToView["data"]["favoritas"] as $favorita):
                            if ($favorita["idPregunta"] == $pregunta["idPregunta"]):
                                $liked = true;
                                break;
                            endif;
                        endforeach;
                        ?>
                        <a class="boton-like" href="#" id-data="<?php echo $pregunta['idPregunta']; ?>" isLiked="<?php echo $liked ? 'true' : 'false'; ?>" controller-data="pregunta">
                            <img class="like-icon" src="assets/img/logo_cora_<?php echo $liked ? 'r' : 'l'; ?>.png" alt="Icono Like">
                        </a>
                        <span class="like-count" id="like-count-<?php echo $pregunta['idPregunta']; ?>"><?php echo $pregunta['like_count']; ?></span>
                    </p>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

        <div class="add-post">
            <a href="index.php?controller=pregunta&action=create"><button class="add-icon"><img src="assets/img/logo_anadir.png" alt="Icono Añadir"></button></a>
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

<!-- Scripts -->
<script src="assets/js/like.js"></script>
<script src="assets/js/bookmark.js"></script>