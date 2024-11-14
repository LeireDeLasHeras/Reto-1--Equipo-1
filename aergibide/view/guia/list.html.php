<?php
/**
 * Vista de la lista de guías.
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
        
                <?php if (empty($dataToView["data"]["guia"])): ?>
                    <p class="empty-data">A&uacute;n no hay gu&iacute;as</p>
                <?php else: ?>
                    <?php foreach ($dataToView["data"]["guia"] as $guia): ?>
                        <div class="post">
                            <h3 class="title">
                                <a href="index.php?controller=guia&action=view&id=<?php echo $guia['idGuia']; ?>">
                                    <?php echo htmlspecialchars($guia["titulo"]); ?>
                                </a>
                                
                                <?php
                                //Comprueba si la guía está guardada para cargar el icono de bookmark guardado o no
                                $saved = false;
                                foreach ($dataToView["data"]["guardadas"] as $guardada):
                                    if ($guardada["idGuia"] == $guia["idGuia"]):
                                        $saved = true;
                                        break;
                                    endif;
                                endforeach;
                                ?> 

                                <a class="bookmark" href="#" id-data="<?php echo $guia['idGuia']; ?>" isSaved="<?php echo $saved ? 'true' : 'false'; ?>" controller-data="guia">
                                    <img src="assets/img/logo_guardar_<?php echo $saved ? 'r' : 'l'; ?>.png" alt="Icono de marcador guardado">
                                </a>


                                <?php
                                //Comprueba si el usuario es el creador de la guía o es admin para mostrar el botón de eliminar
                                if($guia['idUsuario'] == $_SESSION['user_data']['idUsuario'] || $_SESSION['user_data']['tipo'] == 'admin'): ?>
                                    <button class="eliminar" onclick="window.location.href='index.php?controller=guia&action=delete&id=<?php echo $guia['idGuia']; ?>'">
                                        <img class="eliminar-img" src="assets/img/logo_borrar.png" alt="Icono Borrar">
                                        <img class="eliminar-img-hover" src="assets/img/logo_borrar_rojo.png" alt="Icono Borrar">
                                    </button>
                                <?php endif; ?>
                                
                            </h3>
                            <p><?php echo htmlspecialchars($guia["nickname"]); ?><br><?php echo htmlspecialchars($guia["fecha"]); ?></p><br>
                            <p><?php echo strlen($guia['descripcion']) > 75 ? substr($guia['descripcion'], 0, 75) . '...' : $guia['descripcion']; ?></p>

                            <!-- Botón para descargar el archivo directamente -->
                            <?php if (!empty($guia["fichero"])): ?>
                                <p>
                                    <a href="<?php echo htmlentities($guia['fichero']); ?>" download>
                                        <button class="download-button">Descargar</button>
                                    </a>
                                </p>
                            <?php else: ?>
                                <p>No hay archivos asociados a esta gu&iacute;a.</p>
                            <?php endif; ?>

                            <p class="num-like">
                                <?php
                                //Comprueba si la guía está guardada para cargar el icono de like guardado o no
                                $liked = false;
                                foreach ($dataToView["data"]["favoritas"] as $favorita):
                                    if ($favorita["idGuia"] == $guia["idGuia"]):
                                        $liked = true;
                                        break;
                                    endif; 
                                endforeach;
                                ?>
                                
                                <a class="boton-like" href="#" id-data="<?php echo $guia['idGuia']; ?>" isLiked="<?php echo $liked ? 'true' : 'false'; ?>" controller-data="guia">
                                    <img class="like-icon" src="assets/img/logo_cora_<?php echo $liked ? 'r' : 'l'; ?>.png" alt="Icono Like">
                                </a>
                                <span class="like-count" id="like-count-<?php echo $guia['idGuia']; ?>"><?php echo $guia['like_count']; ?></span>
                            </p>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>
                
                <div class="add-post">
                    <a href="index.php?controller=guia&action=create"><button class="add-icon"><img src="assets/img/logo_anadir.png" alt="Icono Añadir"></button></a>
                </div>
    </div>

    <div class="sidebar">
        <h3>Temas</h3>
        <div class="topics">
            <p><a href="index.php?controller=guia&action=list" class="tema">Todos</a></p>
            <p><a href="index.php?controller=guia&action=list&tema=Seguridad" class="tema">Seguridad</a></p>
            <p><a href="index.php?controller=guia&action=list&tema=Aviones" class="tema">Aviones</a></p>
            <p><a href="index.php?controller=guia&action=list&tema=Piezas" class="tema">Piezas</a></p>
            <p><a href="index.php?controller=guia&action=list&tema=Vuelos" class="tema">Vuelos</a></p>
            <p><a href="index.php?controller=guia&action=list&tema=Reparaciones" class="tema">Reparaciones</a></p>
        </div>
        <h3>Ordenar</h3>
        <div class="topics">
            <p><a href="index.php?controller=guia&action=list&tema=MasRecientes" class="tema">M&aacute;s recientes</a></p>
            <p><a href="index.php?controller=guia&action=list&tema=MasAntiguos" class="tema">M&aacute;s antiguos</a></p>
            <p><a href="index.php?controller=guia&action=list&tema=MasPopulares" class="tema">M&aacute;s populares</a></p>
        </div>
    </div>
</div>
<script src="assets/js/bookmark.js"></script>
<script src="assets/js/like.js"></script>