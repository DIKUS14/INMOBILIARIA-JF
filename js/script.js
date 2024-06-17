// script.js

document.addEventListener("DOMContentLoaded", function () {
    // Captura de elementos
    const tarjetasSection = document.getElementById("tarjetasSection");
    const verMasBtn = document.getElementById("verMasBtn");
    const ocultarBtn = document.getElementById("ocultarBtn");

    // Función para mostrar más tarjetas
    function mostrarMasTarjetas() {
        // Obtiene todas las tarjetas dentro de la sección
        const tarjetas = tarjetasSection.querySelectorAll('.card');

        // Itera sobre todas las tarjetas y las muestra
        for (let i = 6; i < tarjetas.length; i++) {
            tarjetas[i].style.display = "block";
        }

        // Muestra el botón "Ocultar"
        ocultarBtn.style.display = "inline";

        // Oculta el botón "Ver más" después de mostrar todas las tarjetas
        verMasBtn.style.display = "none";
    }

    // Función para ocultar las tarjetas extras
    function ocultarTarjetasExtras() {
        // Obtiene todas las tarjetas dentro de la sección
        const tarjetas = tarjetasSection.querySelectorAll('.card');

        // Itera sobre las tarjetas extras y las oculta
        for (let i = 6; i < tarjetas.length; i++) {
            tarjetas[i].style.display = "none";
        }

        // Muestra el botón "Ver más"
        verMasBtn.style.display = "inline";

        // Oculta el botón "Ocultar"
        ocultarBtn.style.display = "none";
    }

    // Oculta las tarjetas 7, 8 y 9 inicialmente
    const tarjetas = tarjetasSection.querySelectorAll('.card');
    for (let i = 6; i < tarjetas.length; i++) {
        tarjetas[i].style.display = "none";
    }

    // Agrega eventos a los botones
    verMasBtn.addEventListener("click", mostrarMasTarjetas);
    ocultarBtn.addEventListener("click", ocultarTarjetasExtras);
});

// botones

// Obtener referencia a los botones
var verMasBtn = document.getElementById('verMasBtn');
var ocultarBtn = document.getElementById('ocultarBtn');

// Agregar un evento click al botón "Ver más"
verMasBtn.addEventListener('click', function () {

    // Ocultar el botón "Ver más"
    verMasBtn.style.display = 'none';

    // Mostrar el botón "Ocultar"
    ocultarBtn.style.display = 'inline-block';
});

// Agregar un evento click al botón "Ocultar"
ocultarBtn.addEventListener('click', function () {
    // Lógica para ocultar tarjetas
    // ...

    // Ocultar el botón "Ocultar"
    ocultarBtn.style.display = 'none';

    // Mostrar el botón "Ver más"
    verMasBtn.style.display = 'inline-block';
});

// Inicialmente ocultar el botón "Ocultar"
ocultarBtn.style.display = 'none';





function toggleBookmark(idInmueble) {
    var bookmark = document.querySelector(".bookmark-" + idInmueble);
    var bookmarkFill = document.querySelector(".bookmark-fill-" + idInmueble);
    var isBookmarked = bookmarkFill.classList.contains("active"); // Verifica si está marcado como favorito o no

    // Toggle classes to show/hide bookmarks
    bookmark.classList.toggle("active");
    bookmarkFill.classList.toggle("active");

    // Envía una solicitud AJAX al servidor para guardar la información en la base de datos
    guardar_inmueble(idInmueble, !isBookmarked); // El segundo parámetro indica si se está marcando o desmarcando como favorito
}

function guardar_inmueble(idInmueble, isFavorite) {
    // Crear una instancia de XMLHttpRequest
    var xhr = new XMLHttpRequest();
    // Definir el método y la URL de la solicitud
    xhr.open("POST", "guardar_inmueble.php", true);
    // Establecer el encabezado Content-Type para enviar datos de formulario
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    // Definir la función de devolución de llamada cuando la solicitud esté completa
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // La solicitud se completó correctamente
            console.log(xhr.responseText);
        }
    };
    // Construir la cadena de consulta para enviar datos al servidor
    var data = "idInmueble=" + idInmueble + "&isFavorite=" + (isFavorite ? 1 : 0);
    // Enviar la solicitud con los datos
    xhr.send(data);
}



// Función para redirigir a la página principal sin parámetros de búsqueda
function limpiarFiltros() {
    window.location.href = 'entrar_admin.php';
}

// Asociar la función al evento de clic del botón Limpiar
document.getElementById('limpiarBtn').addEventListener('click', limpiarFiltros);



