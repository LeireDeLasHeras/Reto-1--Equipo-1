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
            case 'publicadas':
                window.location.href = 'index.php?controller=user&action=published';
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
