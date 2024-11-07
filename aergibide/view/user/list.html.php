<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas</title>
    <link rel="icon" href="../Media/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/comunes_style.css">
    <script src="assets/js/scroll.js"></script>
</head>

<body>
    <div class="container">
        <div class="main-content">
            <div class="content-left">
                <?php foreach ($dataToView["data"] as $usuario): ?>
                    <?php if ($usuario["idUsuario"] == $_SESSION['user_data']['idUsuario']) continue; ?>
                    <div class="post">
                        <h3 class="title">
                            <a style="text-decoration: none; color: white; transition: color 0.2s;" onmouseover="this.style.color='#63D471'" onmouseout="this.style.color='white'" href="index.php?controller=user&action=publicaciones&tipo=todas&idUsuario=<?php echo $usuario["idUsuario"]; ?>">
                                <?php echo $usuario["nickname"]; ?>
                            </a>

                            <button class="eliminar" onclick="window.location.href='index.php?controller=user&action=delete&id=<?php echo $usuario['idUsuario']; ?>'">
                                <img class="eliminar-img" src="assets/img/logo_borrar.png" alt="Icono Borrar">
                                <img class="eliminar-img-hover" src="assets/img/logo_borrar_rojo.png" alt="Icono Borrar">
                            </button>

                        </h3>
                        <p style="text-align: justify; max-width: 90%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $usuario["correo"]; ?></p>
                        <br>
                        <p style="text-align: justify; max-width: 90%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $usuario["nombre"]; ?> <?php echo $usuario["apellido"]; ?></p>
                        <br>
                        <p>Admin</p>

                        <?php
                        $admin = false;
                        if ($usuario["tipo"] == 'admin'):
                            $admin = true;
                        endif;
                        ?>

                        <a class="admin-switch"
                            href="index.php?controller=user&action=<?php echo $admin ? 'normal' : 'admin'; ?>&id=<?php echo $usuario['idUsuario']; ?>">
                            <img class="admin-icon" width="50px " src="assets/img/switch_admin_<?php echo $admin ? 'select' : 'unselect'; ?>.png" alt="Icono Switch Admin">
                        </a>

                    </div>
                    <hr style="width: 90%;">

                <?php endforeach; ?>

            </div>

        </div>
    </div>
</body>