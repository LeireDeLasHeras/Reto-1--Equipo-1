<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mockup Layout</title>
    <link rel="stylesheet" href="assets/css/formulario_style.css">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <img class="logo" src="../Media/logo_aergibide.png" alt="Logo Aergibide">
            <nav class="menu">
                <ul>
                    <li><a href="" class="menu-item">PREGUNTAS</a></li>
                    <li><a href="../HTML/PaginaTutoriales.html" class="menu-item">TUTORIALES</a></li>               
                    <li><a href="../HTML/PaginaGuias.html" class="menu-item">GUIAS</a></li>
                </ul>
            </nav>
            <div class="user-info">
                <span><a href="#" class="menu-item">USER</a></span>
                <div class="user-avatar"></div>
            </div>
        </div>

        <div class="main-content">              
            <div class="contenido">
                <div class="formulario-post">
                    <form action="#" method="post" enctype="multipart/form-data">
                        

                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" >
                
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" id="apellidos" name="apellidos"></input>

                        <label for="usuario">Nombre de Usuario:</label>
                        <input type="text" id="usuario" name="usuario">
                
                        <label for="contrasena">Contraseña:</label>
                        <input type="password" id="contrasena" name="contrasena"></input>

                        <label for="perfil">Foto de Perfil:</label>
                        <input type="file" id="perfil" name="perfil">

                        <div class="form-buttons">
                            <button type="button" class="cancel-button">Cancelar</button>
                            <button type="submit" class="submit-button">Publicar</button>
                        </div>
                    </form>
                </div>      
            </div>
        </div>

        <div class="footer">
            <img src="../Media/logo_aergibide_letras.png" alt="Aergibide Logo" width="13%">
        </div>
    </div>
</body>