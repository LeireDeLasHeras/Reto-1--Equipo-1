<?php

/**
 * Vista para crear una respuesta.
 * 
 * @author Oier Albeniz
 * @author Leire de las Heras
 * @author Joseba Fernandez
 * 
 * @copyright (c) 2024, Oier Albeniz, Leire de las Heras, Joseba Fernandez
 */
?>

<div class="main-content-formulario">
    <div class="contenido">
        <div class="formulario-post">

            <script src="assets/js/crear_respuesta.js"></script>

            <form action="index.php?controller=respuesta&action=create&id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
                <label for="respuesta">Respuesta:</label>
                <textarea id="respuesta" name="respuesta" placeholder="Escribe una respuesta..."></textarea>

                <label for="archivos">A&ntilde;adir archivos:</label>
                <input type="file" id="archivos" name="archivos">

                <div class="form-buttons">
                    <button type="button" class="cancel-button">Cancelar</button>
                    <input type="submit" class="submit-button" value="Publicar">
                </div>
            </form>
        </div>
    </div>
</div>