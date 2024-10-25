<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarme</title>
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/registro_style.css">
    <script src="assets/js/registro.js" ></script>
</head>
<body>
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
        </form>
    </main>
</body>
    