<?php

/**
 * Vista para eliminar una pregunta.
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
        <h1>Eliminar pregunta</h1>
        <p>¿Estas seguro que quieres eliminar la pregunta?</p>
        <form class="borrar" action="index.php?controller=pregunta&action=delete&id=<?php echo $_GET["id"]; ?>" method="post">
            <input type="submit" name="delete" value="Sí, eliminar">
            <input type="button" name="cancel" value="No, cancelar" onclick="window.history.back()">
        </form>
    </div>
</div>