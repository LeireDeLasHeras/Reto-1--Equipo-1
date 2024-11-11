<?php
/**
 * Vista para eliminar una respuesta.
 * 
 * @author Oier Albeniz
 * @author Leire de las Heras
 * @author Joseba Fernandez
 * 
 * @copyright (c) 2024, Oier Albeniz, Leire de las Heras, Joseba Fernandez
 */
?>

<div class="main-content">
    <div class="content-left-borrar">
        <h1>Eliminar respuesta</h1>
        <p>¿Estás seguro de que quieres eliminar la respuesta?</p>
        <form class="borrar" action="index.php?controller=respuesta&action=delete&idRespuesta=<?php echo $_GET["idRespuesta"]; ?>&idPregunta=<?php echo $_GET["idPregunta"]; ?>" method="post">
            <input type="submit" name="delete" value="Sí, eliminar">
            <input type="button" name="cancel" value="No, cancelar" onclick="window.history.back()">
        </form>
    </div>
</div>
        
