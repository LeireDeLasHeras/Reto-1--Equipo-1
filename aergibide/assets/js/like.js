document.addEventListener("DOMContentLoaded", function() {
    var likes = document.getElementsByClassName("boton-like");

    for (var i = 0; i < likes.length; i++) {
        likes[i].addEventListener("click", function(event) {
            event.preventDefault();
            var id = this.getAttribute('id-data');
            var controller = this.getAttribute('controller-data');
            var xhr = new XMLHttpRequest();
            var action = this.getAttribute('isLiked') === 'true' ? 'unlike' : 'like';
            var elemento = this;

            xhr.open('POST', 'index.php?controller=' + controller + '&action=' + action + '&id=' + id);    
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.status === 200) {
                    if (action === 'like') {
                        elemento.setAttribute('isLiked', 'true');
                        elemento.innerHTML = '<img src="assets/img/logo_cora_r.png" alt="Icono Like">';
                    } else {
                        elemento.setAttribute('isLiked', 'false');
                        elemento.innerHTML = '<img src="assets/img/logo_cora_l.png" alt="Icono Like">';
                    }
                }
            };
            xhr.send();
        }); 
    }
});
