document.getElementById('registroForm').addEventListener('submit', function(event) {
    const usuario = document.getElementById('usuario').value;
    const password = document.getElementById('password').value;

    if (usuario === '' || password === '') {
        alert('Todos los campos son obligatorios');
        event.preventDefault();
    }

    if (contrasena.length < 6) {
        alert('La contraseña debe tener al menos 6 caracteres.');
        event.preventDefault();
    }
});
