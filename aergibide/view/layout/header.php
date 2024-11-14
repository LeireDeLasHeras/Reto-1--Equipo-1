<?php
/**
 * Cabecera de la aplicación.
 */
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Codificación -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive -->
    <title>Aergibide</title>
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon"> <!-- Icono -->
    <script src="assets/js/desplegable.js"></script> <!-- Script del menú -->
    <link rel="stylesheet" href="assets/css/comunes_style.css"> <!-- Estilos -->
</head>
<body>
    <div class="container"> <!-- Contenedor principal -->
        <div class="navbar"> <!-- Navegación -->
            <a href="index.php?controller=pregunta&action=list"><img class="logo" src="assets/img/logo_aergibide.png" alt="Logo Aergibide"></a>
            <nav class="menu">
                <ul>
                    <a href="index.php?controller=pregunta&action=list" class="menu-item"><li>PREGUNTAS</li></a>
                    <a href="index.php?controller=tutorial&action=list" class="menu-item"><li>TUTORIALES</li></a>
                    <a href="index.php?controller=guia&action=list" class="menu-item"><li>GU&Iacute;AS</li></a>
                </ul>
            </nav>
            <div class="user-info"> <!-- Info del usuario -->
                <span>
                    <select class="user-options" name="opciones" id="opciones">
                        <option value="user" disabled selected><?php echo $_SESSION['user_data']['nickname']; ?></option>
                        <option value="editar">Editar Perfil</option>
                        <option value="publicaciones">Mis Publicaciones</option>
                        <option value="guardadas">Guardadas</option>
                        <option value="logout">Cerrar Sesi&oacute;n</option>
                        <?php if ($_SESSION['user_data']['tipo']=='admin'): ?>
                            <option value="users">Gestionar Usuarios</option>
                        <?php endif; ?>
                    </select>
                </span>
            </div>
        </div>