<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Iniciar sesi&oacute;n</title>
        <link rel="icon" href="../../public/img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../../public/css/login_style.css">
    </head>
    <body>
        <main>
            <div class="logo">
                <img class="logo_aergibide" src="../../public/img/logo_aergibide.png" alt="Logo Aergibide">
            </div>

            <form action="../models/login.php" method="POST">
                <label for="usuario">Correo electrónico:</label>
                <input type="text" id="usuario" class="input_usuario" name="correo">

                <label for="password">Contraseña:</label>
                <input type="password" id="password" class="input_password" name="password">

                <input type="submit" class="boton_login" value="Iniciar Sesión">
                <a href="index.php?controller=user&action=registro" class="boton_registro">Registrarme</a>
            </form>
        </main>
    </body>
</html>