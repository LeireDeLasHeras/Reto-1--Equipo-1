function toggleBookmark(idPregunta, isSaved) {
    const action = isSaved ? 'borrarGuardada' : 'guardarPregunta';
    
    fetch(`index.php?controller=pregunta&action=${action}&id=${idPregunta}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=UTF-8'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la solicitud: ' + response.statusText);
        }
        return response.json();
    })
    .catch(error => {
        console.error('Error en la solicitud AJAX:', error);
    });
}