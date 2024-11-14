<?php

/**
 * Vista para eliminar un tutorial.
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
        <h1>Eliminar tutorial</h1>
        <p>¿Estas seguro que quieres eliminar el tutorial?</p>
        <form class="borrar" action="index.php?controller=tutorial&action=delete&id=<?php echo $_GET["id"]; ?>" method="post">
            <input type="submit" name="delete" value="Sí, eliminar">
            <input type="button" name="cancel" value="No, cancelar" onclick="window.history.back()">
        </form>
    </div>
</div>