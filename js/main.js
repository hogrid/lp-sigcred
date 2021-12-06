function windowResize() {
    screW = window.innerWidth;
    screH = window.innerHeight;
}
$(document).ready(function () {
    windowResize();
    $(window).resize(function () {
        // pega tamanhos sempre que a tela for redimensionada
        windowResize();
    }); 
});