/**
 * Script para validar el formulario de creación de tutoriales.
 *
 * @author Oier Albeniz
 * @author Leire de las Heras
 * @author Joseba Fernández
 */

document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const tituloInput = document.getElementById("titulo");
  const descripcionInput = document.getElementById("descripcion");
  const temaInput = document.getElementById("tema");
  const enlaceInput = document.getElementById("enlace");

  function mostrarMensajeError(input, mensaje) {
    const error = input.parentElement.querySelector(".error-container");
    if (error) {
      error.remove();
    }

    const mensajeError = document.createElement("div");
    mensajeError.classList.add("error-container");

    const iconoError = document.createElement("span");
    iconoError.classList.add("icono-error");
    iconoError.textContent = "⚠";

    const textoError = document.createElement("span");
    textoError.classList.add("texto-error");
    textoError.textContent = mensaje;

    mensajeError.appendChild(iconoError);
    mensajeError.appendChild(textoError);

    input.after(mensajeError);
  }

  function limpiarMensajesError() {
    const errores = document.querySelectorAll(".error-container");
    errores.forEach((error) => error.remove());
  }

  function extraerIdVideo(url) {
    const patterns = [
      /(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([^&]+)/,
      /(?:https?:\/\/)?(?:www\.)?youtube\.com\/embed\/([^?]+)/,
      /(?:https?:\/\/)?youtu\.be\/([^?]+)/,
    ];

    for (let pattern of patterns) {
      const match = url.match(pattern);
      if (match && match[1]) {
        return match[1];
      }
    }

    return null;
  }

  form.addEventListener("submit", function (event) {
    event.preventDefault();
    limpiarMensajesError();
    let esValido = true;

    if (tituloInput.value.length < 10) {
      mostrarMensajeError(
        tituloInput,
        "El título debe tener al menos 10 caracteres"
      );
      esValido = false;
    }

    if (descripcionInput.value.length < 20) {
      mostrarMensajeError(
        descripcionInput,
        "La descripción debe tener al menos 20 caracteres"
      );
      esValido = false;
    }

    if (!enlaceInput.value) {
      mostrarMensajeError(
        enlaceInput,
        "Debe proporcionar un enlace de YouTube"
      );
      esValido = false;
    } else {
      const videoId = extraerIdVideo(enlaceInput.value);
      if (!videoId) {
        mostrarMensajeError(
          enlaceInput,
          "El enlace debe ser una URL válida de YouTube"
        );
        esValido = false;
      } else {
        enlaceInput.value = videoId;
      }
    }

    if (esValido) {
      form.submit();
    }
  });

  const cancelButton = document.querySelector(".cancel-button");
  if (cancelButton) {
    cancelButton.addEventListener("click", function () {
      window.location.href = "index.php?controller=tutorial&action=list";
    });
  }
});
