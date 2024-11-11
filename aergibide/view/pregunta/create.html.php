<?php
/**
 * Vista para crear una pregunta.
 * 
 * @author Oier Albeniz
 * @author Leire de las Heras
 * @author Joseba Fernández
 * 
 * @copyright (c) 2024, Oier Albeniz, Leire de las Heras, Joseba Fernández
 */
?>

<div class="main-content-formulario">
    <div class="contenido">
        <div class="formulario-post">

            <script src="assets/js/crear_pregunta.js"></script>

            <form action="index.php?controller=pregunta&action=create" method="POST">
                <label for="titulo">Título:</label>
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
                
                <div class="form-buttons">
                    <button type="button" class="cancel-button">Cancelar</button>
                    <input type="submit" class="submit-button" value="Publicar">
                </div>
            </form>
        </div>
    </div>
</div>