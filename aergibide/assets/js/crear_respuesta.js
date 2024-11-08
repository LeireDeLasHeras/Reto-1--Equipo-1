document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const respuestaInput = document.getElementById('respuesta');

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

        if (respuestaInput.value.length > 500) {
            mostrarMensajeError(respuestaInput, "La longitud máxima es de 500 caracteres");
            esValido = false;
        }

        if (!esValido) {
            event.preventDefault();
        }
    });

    const cancelButton = document.querySelector('.cancel-button');
    if (cancelButton) {
        cancelButton.addEventListener('click', function() {
            window.history.back();
        });
    }
});
