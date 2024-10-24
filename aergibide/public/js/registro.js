function validarRegistro(event) {
    event.preventDefault();

    const nombre = document.getElementById('nombre').value;
    const correo = document.getElementById('correo').value;
    const contrasena = document.getElementById('password').value;

    if (nombre.length < 4 || nombre.length > 50) {
        alert('El nombre debe tener entre 4 y 50 caracteres.');
        return;
    }

    if (contrasena.length < 8) {
        alert('La contraseña debe tener al menos 8 caracteres.');
        return;
    }

    verificarCorreo(correo).then(correoEnUso => {
        if (correoEnUso) {
            alert('El correo ya está en uso. Por favor, utiliza otro.');
        } else {
            document.querySelector('form').submit();
        }
    });
}

async function verificarCorreo(correo) {
    try {
        const response = await fetch('../models/verificar_correo.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `correo=${encodeURIComponent(correo)}`
        });
        const data = await response.json();
        return data.enUso;
    } catch (error) {
        console.error('Error al verificar el correo:', error);
        return false;
    }
}

document.querySelector('form').addEventListener('submit', validarRegistro);
