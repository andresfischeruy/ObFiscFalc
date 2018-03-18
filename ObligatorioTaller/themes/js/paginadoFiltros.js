$(document).ready(function () {
    cargarPublicaciones("", "", "", "");
    $("#filtrar").click(function () {
        var tipo = $("#comboTiposIndex").val();
        var especie = $("#comboEspeciesIndex").val();
        var raza = $("#comboRazasIndex").val();
        var barrio = $("#comboBarriosIndex").val();
        cargarPublicaciones(tipo, especie, raza, barrio);
    });
    $("#quitarFiltro").click(function () {
        cargarPublicaciones("", "", "", "");
    });
    $("#comboEspeciesIndex").change(llenarComboRazasIndex);

});


var paginaActual = 0;

function cargarPublicaciones(tipo, especie, raza, barrio) {
    $.ajax({
        url: "paginaPublicaciones.php?pagina=" + paginaActual + "&tipo=" + tipo + "&especie=" + especie + "&raza=" + raza + "&barrio=" + barrio,
        dataType: 'html',
        type: "get",
        data: {pagina: paginaActual, tipo: tipo, especie: especie, raza: raza, barrio: barrio}
    }).done(function (html) {
        $("#contenido").html(html);

        $("#siguiente").click(function () {
            paginaActual += 1;
            cargarPublicaciones(tipo, especie, raza, barrio);
        });

        $("#anterior").click(function () {
            paginaActual -= 1;
            cargarPublicaciones(tipo, especie, raza, barrio);
        });

    });
}

function llenarComboRazasIndex() {
    var especie = $("#comboEspeciesIndex").val();
    alert(especie);
    $.ajax({
        url: "request.php?esp=" + especie,
        dataType: 'html',
        type: "get"

    }).done(function (html) {
        $("#comboRazasIndex").html(html);
    });

}


