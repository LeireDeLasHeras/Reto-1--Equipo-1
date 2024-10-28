<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas</title>
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
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
                        <option value="user">Usuario</option>
                        <option value="editar">Editar Perfil</option>
                        <option value="publicadas">Publicadas</option>
                        <option value="guardadas">Guardados</option>
                </select></span>
                <div class="user-avatar"></div>
            </div>
        </div>