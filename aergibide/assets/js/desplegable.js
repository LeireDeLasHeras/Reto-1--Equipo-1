/**
 * Script para manejar el desplegable de la barra de navegación.
 * 
 * @author Oier Albeniz
 * @author Leire de las Heras
 * @author Joseba Fernández
 */

document.addEventListener('DOMContentLoaded', function() {
    var userOptions = document.getElementById('opciones');
    userOptions.addEventListener('change', function() {
        var selectedOption = this.value;
        switch(selectedOption) {
            case 'user':
                window.location.href = 'index.php?controller=user&action=profile';
                break;
            case 'editar':
                window.location.href = 'index.php?controller=user&action=edit'; 
                break;
            case 'publicaciones':
                window.location.href = 'index.php?controller=user&action=publicaciones&tipo=todas';
                break;
            case 'guardadas':
                window.location.href = 'index.php?controller=user&action=guardadas&tipo=todas';
                break;
            case 'logout':
                window.location.href = 'index.php?controller=user&action=logout';
                break;
            case 'users':
                window.location.href = 'index.php?controller=user&action=list';
                break;
            default:
                console.log('Opción no válida');
        }
    });
});
