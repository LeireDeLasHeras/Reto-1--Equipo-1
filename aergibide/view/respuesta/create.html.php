<link rel="stylesheet" href="assets/css/comunes_style.css">
<div class="container">
    <div class="main-content">              
        <div class="contenido">
                <div class="formulario-post">
                    <form action="index.php?controller=respuesta&action=create&id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
                        <label for="respuesta">Respuesta:</label>
                        <textarea id="respuesta" name="respuesta" placeholder="Escribe una respuesta..."></textarea>               
                        
                        <label for="archivos">Añadir archivos:</label>
                        <input type="file" id="archivos" name="archivos">
                        
                        <div class="form-buttons">
                            <button type="button" class="cancel-button">Cancelar</button>
                            <input type="submit" class="submit-button" value="Publicar">
                        </div>
                        <script src="assets/js/crear_respuesta.js"></script>
                    </form>
                </div>      
            </div>
        </div>
    </div>