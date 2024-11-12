<?php
/**
 * Vista para el registro de usuario
 * 
 * @author: Oier Albeniz
 * @author: Leire de las Heras
 * @author: Joseba Fernández
 * 
 * @copyright (c) 2024, Oier Albeniz, Leire de las Heras, Joseba Fernández
 */
?>

<!-- Carga del archivo de estilos ya que el login y registro no cargan el layout -->
<link rel="stylesheet" href="assets/css/registro_style.css">

<main>
    <div class="logo">
        <img class="logo_aergibide" src="assets/img/logo_aergibide.png" alt="Logo Aergibide">
    </div>

    <form action="index.php?controller=user&action=register" method="POST">
        <label for="nickname">Nickname:</label>
        <input type="text" id="nickname" class="input_nickname" name="nickname" required>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" class="input_nombre" name="nombre" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" class="input_apellido" name="apellido" required>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" class="input_correo" name="correo" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" class="input_password" name="password" required>

        <input type="submit" id="submit" name="submit" class="boton_registro" value="Registrarme">
        <input type="button" id="cancel" name="cancel" class="boton_cancelar_registro" value="Cancelar" onclick="window.history.back()">
    </form>
</main>
