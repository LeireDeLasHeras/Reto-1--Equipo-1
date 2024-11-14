/**
 * Script para manejar los likes de la aplicación
 * de manera asíncrona.
 * 
 * @author Oier Albeniz
 * @author Leire de las Heras
 * @author Joseba Fernández
 */

document.addEventListener("DOMContentLoaded", function () {
    var likes = document.getElementsByClassName("boton-like");

    for (var i = 0; i < likes.length; i++) {
        likes[i].addEventListener("click", function (event) {
            event.preventDefault();
            var id = this.getAttribute('id-data');
            var controller = this.getAttribute('controller-data');
            var xhr = new XMLHttpRequest();
            var action = this.getAttribute('isLiked') === 'true' ? 'unlike' : 'like';
            var elemento = this;

            xhr.open('POST', 'index.php?controller=' + controller + '&action=' + action);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // Agrega esta línea

            xhr.onload = function () {
                if (this.status === 200) {
                    var response = JSON.parse(this.responseText);
                    if (response.success) {
                        // Actualiza el estado del like
                        if (action === 'like') {
                            elemento.setAttribute('isLiked', 'true');
                            elemento.innerHTML = '<img src="assets/img/logo_cora_r.png" alt="Icono Like">';
                        } else {
                            elemento.setAttribute('isLiked', 'false');
                            elemento.innerHTML = '<img src="assets/img/logo_cora_l.png" alt="Icono Like">';
                        }
                    }
                    // Actualiza el contador de likes
                    var likeCountElement = document.getElementById('like-count-' + id);
                    if (likeCountElement) {
                        likeCountElement.innerText = response.newLikeCount;
                    }

                }
            };
            xhr.send('id=' + id);
        });
    }
});