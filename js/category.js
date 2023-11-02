    
var prevScrollpos = window.pageYOffset;
var navbar = document.getElementById("nav-category");
var hideTimeout;

window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    
    if (prevScrollpos > currentScrollPos) {
        // Mostrar la barra de navegación al desplazar hacia arriba
        navbar.style.position = "sticky";
        navbar.style.top = "0px";
        clearTimeout(hideTimeout); // Limpiar el temporizador
    } else {
        // Ocultar la barra de navegación al desplazar hacia abajo
        navbar.style.top = "-300px";
    }
    
    prevScrollpos = currentScrollPos;
    
    // Establecer un temporizador para ocultar la barra después de 2 segundos de inactividad
    if (!hideTimeout) {
        hideTimeout = setInterval(function() {
            navbar.style.top = "-300px";
            hideTimeout = null;
        }, 4000); // Puedes ajustar el tiempo (en milisegundos) según tus preferencias
    }
}

