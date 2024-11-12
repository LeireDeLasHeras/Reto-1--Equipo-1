<?php
/**
 * Cabecera de la aplicación.
 * 
 * @author Oier Albeniz
 * @author Leire de las Heras
 * @author Joseba Fernández
 * 
 * @copyright (c) 2024, Oier Albeniz, Leire de las Heras, Joseba Fernández
 */
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aergibide</title>
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
    <script src="assets/js/desplegable.js"></script>
    <link rel="stylesheet" href="assets/css/comunes_style.css">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <img class="logo" src="assets/img/logo_aergibide.png" alt="Logo Aergibide">
            <nav class="menu">
                <ul>
                <a href="index.php?controller=pregunta&action=list" class="menu-item"><li>PREGUNTAS</li></a>
                <a href="index.php?controller=tutorial&action=list" class="menu-item"><li>TUTORIALES</li></a>               
                <a href="index.php?controller=guia&action=list" class="menu-item"><li>GU&Iacute;AS</li></a>
                </ul>
            </nav>
            <div class="user-info">
                <span>                    
                    <select class="user-options" name="opciones" id="opciones">
                        <option value="user" disabled selected><?php echo $_SESSION['user_data']['nickname']; ?></option>
                        <option value="editar">Editar Perfil</option>
                        <option value="publicaciones">Mis Publicaciones</option>
                        <option value="guardadas">Guardadas</option>
                        <option value="logout">Cerrar Sesi&oacute;n</option>
                        <?php 
                        // Carga las opciones de administrador si el usuario lo es
                        if ($_SESSION['user_data']['tipo']=='admin'): ?>
                            <option value="users">Gestionar Usuarios</option>
                        <?php endif; ?>
                        
                    </select>
                </span>
            </div>
        </div>
    