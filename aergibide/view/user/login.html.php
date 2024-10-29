    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Iniciar sesión</title>
        <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="assets/css/login_style.css">
    </head>
    <body>
        <main>
            <div class="logo">
                <img class="logo_aergibide" src="assets/img/logo_aergibide.png" alt="Logo Aergibide">
            </div>

            <form action="" method="POST">
                <label for="correo">Correo electrónico:</label>
                <input type="text" id="correo" class="input_correo" name="correo" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" class="input_password" name="password" required>

                <!-- Añadir name="submit" al botón de envío para que se detecte en el controlador -->
                <input type="submit" name="submit" class="boton_login" value="Iniciar Sesión">
                <a href="index.php?controller=user&action=register" class="boton_registro">Registrarme</a>
            </form>
        </main>
    </body>
