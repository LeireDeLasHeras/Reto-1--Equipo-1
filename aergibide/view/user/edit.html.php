<link rel="stylesheet" href="assets/css/formulario_styles.css">
<div class="container">
    <div class="main-content">              
        <div class="contenido">
                <div class="formulario-post">
                <form action="index.php?controller=user&action=update" method="POST">
                        <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['user_data']['idUsuario']; ?>">
                        <label for="perfil">Cambiar Foto:</label>
                        <input type="file" id="perfil" class="input_perfil" name="perfil"  accept=".jpg, .jpeg, .png"  />

                        <label for="nickname">Cambiar Nickname:</label>
                        <input type="text" id="nickname" class="input_nickname" name="nickname" required value=<?php echo $_SESSION['user_data']['nickname']; ?>>

                        <label for="nombre">Cambiar Nombre:</label>
                        <input type="text" id="nombre" class="input_nombre" name="nombre" required value=<?php echo $_SESSION['user_data']['nombre']; ?>>

                        <label for="apellido">Cambiar Apellido:</label>
                        <input type="text" id="apellido" class="input_apellido" name="apellido" required value=<?php echo $_SESSION['user_data']['apellido']; ?>>

                        <label for="password">Cambiar Contraseña:</label>
                        <input type="password" id="password" class="input_password" name="password" placeholder="Nueva Contraseña">

                        <div class="form-buttons">
                            <button type="button" class="cancel-button">Cancelar</button>
                            <input style="color: white;" type="submit" name="sumbit" class="submit-button" value="Guardar">
                        </div>
                    </form>
                </div>      
            </div>
        </div>
    </div>     


    