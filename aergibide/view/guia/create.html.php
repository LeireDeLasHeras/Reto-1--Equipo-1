<link rel="stylesheet" href="assets/css/formulario_styles.css">
<script src="assets/js/crear_guia.js"></script>
<div class="container">
    <div class="main-content">              
        <div class="contenido">
                <div class="formulario-post">
                    <form action="index.php?controller=guia&action=create" method="POST" enctype="multipart/form-data">
                        <label for="titulo">T&iacute;tulo:</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Escribe el título">
                    
                        <label for="tema">Añadir tema:</label>
                        <select id="tema" name="tema">
                            <option value="tema1">Seguridad</option>
                            <option value="tema2">Aviones</option>
                            <option value="tema3">Piezas</option>
                            <option value="tema4">Vuelos</option>
                            <option value="tema5">Reparaciones</option>
                        </select>
                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" placeholder="Escribe una descripción..."></textarea>               

                        <label for="archivos">Añadir archivos:</label>
                        <input type="file" id="archivos" name="archivos">

                        <div class="form-buttons">
                            <button type="button" class="cancel-button">Cancelar</button>
                            <input style="color: white;" type="submit" class="submit-button" value="Publicar">
                        </div>
                    </form>
                </div>      
            </div>
        </div>
    </div>