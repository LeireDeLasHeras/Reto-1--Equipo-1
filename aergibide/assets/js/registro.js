document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const nicknameInput = document.getElementById('nickname');
    const nombreInput = document.getElementById('nombre');
    const apellidoInput = document.getElementById('apellido');
    const correoInput = document.getElementById('correo');
    const passwordInput = document.getElementById('password');

    function mostrarMensajeError(input, mensaje) {
        const error = input.parentElement.querySelector('.error-container');
        if (error) {
            error.remove();
        }

        const mensajeError = document.createElement('div');
        mensajeError.classList.add('error-container');
        
        const iconoError = document.createElement('span');
        iconoError.classList.add('icono-error');
        iconoError.textContent = '⚠';

        const textoError = document.createElement('span');
        textoError.classList.add('texto-error');
        textoError.textContent = mensaje;

        mensajeError.appendChild(iconoError);
        mensajeError.appendChild(textoError);
        
        input.after(mensajeError);
    }

    function limpiarMensajesError() {
        const errores = document.querySelectorAll('.error-container');
        errores.forEach(error => error.remove());
    }

    form.addEventListener('submit', function (event) {
        limpiarMensajesError();
        let esValido = true;

        const nicknamePattern = /^[a-zA-Z0-9_.-]+$/;
        if (!nicknamePattern.test(nicknameInput.value)) {
            mostrarMensajeError(nicknameInput, "El nickname solo puede contener letras, números, y los símbolos especiales: _ , - .");
            esValido = false;
        }

        const nombrePattern = /^[A-Z][a-zA-Z]+$/;
        if (!nombrePattern.test(nombreInput.value)) {
            mostrarMensajeError(nombreInput, "El nombre debe comenzar con una letra mayúscula y contener solo letras.");
            esValido = false;
        }

        const apellidoPattern = /^[A-Z][a-zA-Z]+(\s[A-Z][a-zA-Z]+)?$/;
        if (!apellidoPattern.test(apellidoInput.value)) {
            mostrarMensajeError(apellidoInput, "Ingrese uno o dos apellidos. Cada apellido debe comenzar con mayúscula y contener solo letras.");
            esValido = false;
        }

        const correoPattern = /^[a-zA-Z0-9._%+-]+@egibide\.org$/;
        if (!correoPattern.test(correoInput.value)) {
            mostrarMensajeError(correoInput, "El correo debe terminar con @egibide.org.");
            esValido = false;
        }
        const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[.,-_]).{8,}$/;
        if (!passwordPattern.test(passwordInput.value)) {
            mostrarMensajeError(passwordInput, "La contraseña debe tener al menos 8 caracteres, con 1 número, 1 mayúscula y 1 caracter especial (. , - _).");
            esValido = false;
        }

        if (!esValido) {
            event.preventDefault();
        }
    });
});
