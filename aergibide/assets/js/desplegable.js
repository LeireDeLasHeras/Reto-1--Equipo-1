document.addEventListener('DOMContentLoaded', function() {
    var userOptions = document.getElementById('opciones');
    userOptions.addEventListener('change', function() {
        var selectedOption = this.value;
        console.log(selectedOption);
        switch(selectedOption) {
            case 'user':
                window.location.href = 'index.php?controller=user&action=profile';
                break;
            case 'editar':
                window.location.href = 'index.php?controller=user&action=edit'; 
                console.log('editar');
                break;
            case 'publicaciones':
                window.location.href = 'index.php?controller=user&action=publicaciones';
                console.log('publicacion');
                break;
            case 'guardadas':
                window.location.href = 'index.php?controller=user&action=saved';
                break;
            case 'logout':
                window.location.href = 'index.php?controller=user&action=logout';
                break;
            default:
                console.log('Opción no válida');
        }
    });
});
