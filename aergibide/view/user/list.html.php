<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas</title>
    <link rel="icon" href="../Media/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/comunes_style.css">
    <script src="assets/js/scroll.js"></script>
</head>

<body>  
    <div class="container-u-p">
        <div class="usuarios-container">
            <?php foreach ($dataToView["data"] as $usuario): ?>
                <?php if ($usuario["idUsuario"] == $_SESSION['user_data']['idUsuario']) continue; ?>
                <div class="user-card">
                    <h2 class="username">
                        <a href="index.php?controller=user&action=publicaciones&tipo=todas&idUsuario=<?php echo $usuario["idUsuario"]; ?>">
                            <?php echo $usuario["nickname"]; ?>
                        </a>

                        <button class="eliminar" onclick="window.location.href='index.php?controller=user&action=delete&id=<?php echo $usuario['idUsuario']; ?>'">
                            <img class="eliminar-img" src="assets/img/logo_borrar.png" alt="Icono Borrar">
                            <img class="eliminar-img-hover" src="assets/img/logo_borrar_rojo.png" alt="Icono Borrar">
                        </button>

                    </h2>
                    <p class="user-attr"><?php echo $usuario["correo"]; ?></p>
                   
                    
                    <p class="user-attr"><?php echo $usuario["nombre"]; ?> <?php echo $usuario["apellido"]; ?></p>
                    
                    <p class="admin-attr">Admin</p>

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
            <?php endforeach; ?>
        </div>
    </div>
</body>