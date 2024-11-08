<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aergibide</title>
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
    <script src="assets/js/desplegable.js"></script>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <img class="logo" src="assets/img/logo_aergibide.png" alt="Logo Aergibide">
            <nav class="menu">
                <ul>
                    <li><a href="index.php?controller=pregunta&action=list" class="menu-item">PREGUNTAS</a></li>
                    <li><a href="index.php?controller=tutorial&action=list" class="menu-item">TUTORIALES</a></li>               
                    <li><a href="index.php?controller=guia&action=list" class="menu-item">GUIAS</a></li>
                </ul>
            </nav>
            <div class="user-info">
                <span>                    
                    <select class="user-options" name="opciones" id="opciones">
                        <option value="user"disabled selected><?php echo $_SESSION['user_data']['nickname']; ?></option>
                        <option value="editar">Editar Perfil</option>
                        <option value="publicaciones">Mis Publicaciones</option>
                        <option value="guardadas">Guardadas</option>
                        <option value="logout">Cerrar Sesión</option>
                        <?php if ($_SESSION['user_data']['tipo']=='admin'): ?>
                            <option value="users">Gestionar Usuarios</option>
                        <?php endif; ?>
                </select></span>
                <!--<div class="user-avatar"></div>-->
            </div>
        </div>