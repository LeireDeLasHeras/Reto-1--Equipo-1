document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const nicknameInput = document.getElementById('nickname');
    const nombreInput = document.getElementById('nombre');
    const apellidoInput = document.getElementById('apellido');
    const correoInput = document.getElementById('correo');
    const passwordInput = document.getElementById('password');

    function mostrarMensajeError(input, mensaje) {
        // Elimina cualquier mensaje de error previo debajo del campo
        const error = input.parentElement.querySelector('.error-container');
        if (error) {
            error.remove();
        }

        // Crea el contenedor del mensaje de error debajo del campo
        const mensajeError = document.createElement('div');
        mensajeError.classList.add('error-container');
        
        // Crea el ícono y el texto del mensaje
        const iconoError = document.createElement('span');
        iconoError.classList.add('icono-error');
        iconoError.textContent = '⚠';  // Aquí puedes usar un icono diferente si lo prefieres

        const textoError = document.createElement('span');
        textoError.classList.add('texto-error');
        textoError.textContent = mensaje;

        mensajeError.appendChild(iconoError);
        mensajeError.appendChild(textoError);
        
        // Insertar el mensaje de error justo debajo del input
        input.after(mensajeError);
    }

    function limpiarMensajesError() {
        const errores = document.querySelectorAll('.error-container');
        errores.forEach(error => error.remove());
    }

    form.addEventListener('submit', function (event) {
        limpiarMensajesError();
        let esValido = true;

        // Validación del nickname (solo permite letras, números y _ , - .)
        const nicknamePattern = /^[a-zA-Z0-9_.-]+$/;
        if (!nicknamePattern.test(nicknameInput.value)) {
            mostrarMensajeError(nicknameInput, "El nickname solo puede contener letras, números, y los símbolos especiales: _ , - .");
            esValido = false;
        }

        // Validación del nombre (solo letras y debe empezar por mayúscula)
        const nombrePattern = /^[A-Z][a-zA-Z]+$/;
        if (!nombrePattern.test(nombreInput.value)) {
            mostrarMensajeError(nombreInput, "El nombre debe comenzar con una letra mayúscula y contener solo letras.");
            esValido = false;
        }

        // Validación del apellido (dos apellidos, ambos comenzando con mayúscula, separados por espacio)
        const apellidoPattern = /^[A-Z][a-zA-Z]+ [A-Z][a-zA-Z]+$/;
        if (!apellidoPattern.test(apellidoInput.value)) {
            mostrarMensajeError(apellidoInput, "Debe ingresar dos apellidos, ambos comenzando con mayúscula, separados por un espacio.");
            esValido = false;
        }

        // Validación del correo (debe terminar en @egibide.org)
        const correoPattern = /^[a-zA-Z0-9._%+-]+@egibide\.org$/;
        if (!correoPattern.test(correoInput.value)) {
            mostrarMensajeError(correoInput, "El correo debe terminar con @egibide.org.");
            esValido = false;
        }

        // Validación de la contraseña (mínimo 8 caracteres, 2 números, 2 caracteres especiales (. , - _), 2 mayúsculas)
        const passwordPattern = /^(?=.*[A-Z].*[A-Z])(?=.*\d.*\d)(?=.*[.,-_].*[.,-_]).{8,}$/;
        if (!passwordPattern.test(passwordInput.value)) {
            mostrarMensajeError(passwordInput, "La contraseña debe tener al menos 8 caracteres, con 2 números, 2 mayúsculas y 2 caracteres especiales (. , - _).");
            esValido = false;
        }

        if (!esValido) {
            event.preventDefault(); // Evita el envío del formulario si hay errores
        }
    });
});
