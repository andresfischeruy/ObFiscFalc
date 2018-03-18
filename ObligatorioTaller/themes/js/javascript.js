$(document).ready(function () {

    $('#myCarousel').carousel({
        interval: 4000
    });

    
    $("#comboEspecies").change(llenarComboRazas);
    $("#comboEspecies").ready(llenarComboRazas);
    cargarPublicaciones();
});


function llenarComboRazas() {
    var especie = document.getElementById("comboEspecies");
    var especieSeleccionada = especie.options[especie.selectedIndex].id;
    $.ajax({
        url: "request.php?esp=" + especieSeleccionada,
        dataType: 'html'
    }).done(function (html) {
        $("#comboRazas").html(html);
    });

}


var paginaActual = 0;

function cargarPublicaciones(tipo, especie, raza, barrio) {
    $.ajax({
        url: "paginaPublicaciones.php?pagina=" + paginaActual,
        dataType: 'html',
        type: "get",
        data: {tipo: tipo, especie: especie, raza: raza, barrio: barrio}
    }).done(function (html) {
        $("#contenido").html(html);

        $("#siguiente").click(function () {
            paginaActual += 1;
            cargarPublicaciones();
        });

        $("#anterior").click(function () {
            paginaActual -= 1;
            cargarPublicaciones();
        });

    });
}

