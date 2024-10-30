<link rel="stylesheet" href="assets/css/formulario_styles.css">
<script src="assets/js/crear_tutorial.js"></script> 
<div class="container">
    <div class="main-content">              
        <div class="contenido">
                <div class="formulario-post">
                    <form action="index.php?controller=tutorial&action=save" method="POST">
                        <label for="titulo">T&iacute;tulo:</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Escribe el título">
                    
                        <label for="tema">Añadir tema:</label>
                        <select id="tema" name="tema">
                            <option value="Seguridad">Seguridad</option>
                            <option value="Aviones">Aviones</option>
                            <option value="Piezas">Piezas</option>
                            <option value="Vuelos">Vuelos</option>
                            <option value="Reparaciones">Reparaciones</option>
                        </select>
                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" placeholder="Escribe una descripción..."></textarea>
                        
                        <label for="enlace">Enlace:</label>
                        <input type="text" id="enlace" name="enlace" placeholder="Pega el enlace del video que quieras añadir">

                        <div class="form-buttons">
                            <button type="button" class="cancel-button">Cancelar</button>
                            <input style="color: white;" type="submit" class="submit-button" value="Publicar">
                        </div>
                    </form>
                </div>      
            </div>
        </div>
    </div>