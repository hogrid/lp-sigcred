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
    $(".money").mask("000.000.000.000.000,00", { reverse: true });
    $('.fone').mask('(00) 0 0000-0000');
    $(".depoimentos").slick({
      slidesToShow: 3,
      dots: true,
      infinite: false,
      variableWidth: true,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            slidesToShow: 3,
            dots: true,
          },
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            slidesToShow: 1,
            dots: true,
          },
        },
      ],
    });
    $("#simulador").on('submit', function(e){
        e.preventDefault();
        var nome = $('#nome').val();
        var fone = $('#fone').val();
        var valor = $('#valor').val();
        var utilizado = 0;
        var liberado = 0;
        valor = valor.replace(".","");
        valor = parseInt(valor);
        utilizado = valor * 0.96;
        liberado = valor * 0.63;
        
        $('#valor1').html('<span id="valor1">' + utilizado.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}) + '</span>');
        $('#valor2').html('<span id="valor2">' + valor.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}) + '</span>');
        $('#valor3').html('<span id="valor3">' + liberado.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}) + '</span>');
        
        $('#resultado').addClass("showBox");
        $('#calculo').addClass("hideBox");
    });
  });
  AOS.init();