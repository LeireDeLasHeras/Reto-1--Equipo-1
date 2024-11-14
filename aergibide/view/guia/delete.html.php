<?php

/**
 * Vista para eliminar una guia.
 * 
 * @author Oier Albeniz
 * @author Leire de las Heras
 * @author Joseba Fernández
 * 
 * @copyright (c) 2024, Oier Albeniz, Leire de las Heras, Joseba Fernández
 */
?>

<div class="main-content">
    <div class="content-left-borrar">
        <h1>Eliminar gu&iacute;a</h1>
        <p>¿Estas seguro que quieres eliminar la gu&iacute;a?</p>
        <form class="borrar" action="index.php?controller=guia&action=delete&id=<?php echo $_GET["id"]; ?>" method="post">
            <input type="submit" name="delete" value="Sí, eliminar">
            <input type="button" name="cancel" value="No, cancelar" onclick="window.history.back()">
        </form>
    </div>
</div>