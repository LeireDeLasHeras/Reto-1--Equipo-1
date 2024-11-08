document.addEventListener("DOMContentLoaded", function() {
    var favoritos = document.getElementsByClassName("bookmark");
    for (var i = 0; i < favoritos.length; i++) {
        favoritos[i].addEventListener("click", function(event) {
            event.preventDefault();
            var id = this.getAttribute('id-data');
            var controller = this.getAttribute('controller-data');
            var xhr = new XMLHttpRequest();
            var action = this.getAttribute('isSaved') === 'true' ? 'unsave' : 'save';
            var elemento = this;

            xhr.open('POST', 'index.php?controller=' + controller + '&action=' + action + '&id=' + id);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.status === 200) {
                    console.log(this.responseText);
                    if (action === 'save') {
                        elemento.setAttribute('isSaved', 'true');
                        elemento.innerHTML = '<img src="assets/img/logo_guardar_r.png" alt="Icono Bookmark guardado">';
                    } else {
                        elemento.setAttribute('isSaved', 'false');
                        elemento.innerHTML = '<img src="assets/img/logo_guardar_l.png" alt="Icono Bookmark no guardado">';
                    }
                }
            };
            xhr.send();
        }); 
    }
});
