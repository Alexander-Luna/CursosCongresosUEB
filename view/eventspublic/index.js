function obtenerEventos() {
    return new Promise((resolve, reject) => {
        fetch('../../controller/evento.php?op=cardevento')
            .then(response => response.text()) // Obtener el cuerpo de la respuesta como texto
            .then(data => resolve(data))
            .catch(error => reject(error));
    });
}

// Llamar a la función y actualizar el contenido del contenedor
obtenerEventos()
    .then(result => {
        // Colocar la respuesta dentro del contenedor con id "eventos-container"
        document.getElementById("eventos-container").innerHTML = result;
    })
    .catch(error => console.error(error));