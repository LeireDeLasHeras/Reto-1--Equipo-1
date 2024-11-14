<?php

/**
 * Vista para crear un tutorial.
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

            <form action="index.php?controller=tutorial&action=create" method="POST">
                <label for="titulo">T&iacute;tulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Escribe el título">

                <label for="tema">A&ntilde;adir tema:</label>
                <select id="tema" name="tema">
                    <option value="Seguridad">Seguridad</option>
                    <option value="Aviones">Aviones</option>
                    <option value="Piezas">Piezas</option>
                    <option value="Vuelos">Vuelos</option>
                    <option value="Reparaciones">Reparaciones</option>
                </select>

                <label for="descripcion">Descripci&oacute;n:</label>
                <textarea id="descripcion" name="descripcion" placeholder="Escribe una descripción..."></textarea>

                <label for="enlace">Enlace de Youtube:</label>
                <input type="text" id="enlace" name="enlace" placeholder="Pega el enlace del video que quieras añadir">

                <div class="form-buttons">
                    <button type="button" class="cancel-button">Cancelar</button>
                    <input type="submit" class="submit-button" value="Publicar">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="assets/js/crear_tutorial.js"></script>