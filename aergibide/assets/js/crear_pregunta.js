/**
 * Script para validar el formulario de creación de preguntas.
 * 
 * @author Oier Albeniz
 * @author Leire de las Heras
 * @author Joseba Fernández
 */

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const tituloInput = document.getElementById('titulo');
    const descripcionInput = document.getElementById('descripcion');
    const temaInput = document.getElementById('tema');

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

        if (tituloInput.value.length < 10) {
            mostrarMensajeError(tituloInput, "El título debe tener al menos 10 caracteres");
            esValido = false;
        }

        if (descripcionInput.value.length < 20) {
            mostrarMensajeError(descripcionInput, "La descripción debe tener al menos 20 caracteres");
            esValido = false;
        }

        if (!temaInput.value) {
            mostrarMensajeError(temaInput, "Debe seleccionar un tema");
            esValido = false;
        }

        if (!esValido) {
            event.preventDefault();
        }
    });

    const cancelButton = document.querySelector('.cancel-button');
    if (cancelButton) {
        cancelButton.addEventListener('click', function() {
            window.location.href = 'index.php?controller=pregunta&action=list';
        });
    }
});
