document.addEventListener('DOMContentLoaded', function() {
    // Selecciona todas las imágenes del carrusel
    const images = document.querySelectorAll('.carousel-img');
    
    // Selecciona el modal y sus elementos relevantes
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const closeBtn = modal.querySelector('.custom-modal-close');
    const prevBtn = modal.querySelector('.custom-modal-prev');
    const nextBtn = modal.querySelector('.custom-modal-next');
    
    // Inicializa el índice de la imagen actual
    let currentIndex = 0;

    // Agrega un evento de clic a cada imagen del carrusel
    images.forEach((img, index) => {
        img.addEventListener('click', function() {
            currentIndex = index; // Actualiza el índice actual
            showImage(currentIndex); // Muestra la imagen seleccionada
            modal.style.display = 'block'; // Muestra el modal
        });
    });

    // Cierra el modal al hacer clic en el botón de cerrar
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Cierra el modal al hacer clic fuera de la imagen en el modal
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Navega a la imagen anterior al hacer clic en el botón de anterior
    prevBtn.addEventListener('click', function() {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1;
        showImage(currentIndex);
    });

    // Navega a la siguiente imagen al hacer clic en el botón de siguiente
    nextBtn.addEventListener('click', function() {
        currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
        showImage(currentIndex);
    });

    // Función para mostrar una imagen específica según el índice
    function showImage(index) {
        modalImage.src = images[index].src;
        modalImage.alt = images[index].alt;
    }
});
