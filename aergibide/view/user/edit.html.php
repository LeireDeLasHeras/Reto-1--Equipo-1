<link rel="stylesheet" href="assets/css/formulario_style.css">
<div class="container">
    <div class="main-content">              
        <div class="contenido">
                <div class="formulario-post">
                    <form action="index.php?controller=user&action=edit" method="POST">
                        <label for="nickname">Cambiar Nickname:</label>
                        <input type="text" id="nickname" class="input_nickname" name="nickname" required>

                        <label for="nombre">Cambiar Nombre:</label>
                        <input type="text" id="nombre" class="input_nombre" name="nombre" required>

                        <label for="apellido">Cambiar Apellido:</label>
                        <input type="text" id="apellido" class="input_apellido" name="apellido" required>

                        <label for="password">Cambiar Contraseña:</label>
                        <input type="password" id="password" class="input_password" name="password" required>

                        <div class="form-buttons">
                            <button type="button" class="cancel-button">Cancelar</button>
                            <input  type="submit" class="submit-button" value="Guardar Cambios">
                        </div>
                    </form>
                </div>      
            </div>
        </div>
    </div>     


    