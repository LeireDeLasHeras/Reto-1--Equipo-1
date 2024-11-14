<?php

/**
 * Vista para el login de usuario
 * 
 * @author: Oier Albeniz
 * @author: Leire de las Heras
 * @author: Joseba Fernández
 * 
 * @copyright (c) 2024, Oier Albeniz, Leire de las Heras, Joseba Fernández
 */
?>

<!-- Carga del archivo de estilos ya que el login y registro no cargan el layout -->
<link rel="stylesheet" href="assets/css/login_style.css">

<main>
    <div class="logo">
        <img class="logo_aergibide" src="assets/img/logo_aergibide.png" alt="Logo Aergibide">
    </div>
    <form action="" method="POST">
        <label for="correo">Correo electrónico:</label>
        <input type="text" id="correo" class="input_correo" name="correo" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" class="input_password" name="password" required>

        <input type="submit" name="submit" class="boton_login" value="Iniciar Sesión">
        <a href="index.php?controller=user&action=register" class="boton_registro">Registrarme</a>
    </form>
</main>