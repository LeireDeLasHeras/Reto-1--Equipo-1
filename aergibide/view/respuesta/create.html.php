<link rel="stylesheet" href="assets/css/formulario_styles.css">
<div class="container">
    <div class="main-content">              
        <div class="contenido">
                <div class="formulario-post">
                    <form action="index.php?controller=respuesta&action=create&id=<?php echo $_GET['id']; ?>" method="POST">
                        <label for="respuesta">Respuesta:</label>
                        <textarea id="respuesta" name="respuesta" placeholder="Escribe una respuesta..."></textarea>               
                        
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