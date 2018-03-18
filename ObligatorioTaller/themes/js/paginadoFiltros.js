$(document).ready(function () {
    cargarPublicaciones("", "", "", "","");
    $("#filtrar").click(function () {
        var tipo = $("#comboTiposIndex").val();
        var especie = $("#comboEspeciesIndex").val();
        var raza = $("#comboRazasIndex").val();
        var barrio = $("#comboBarriosIndex").val();
        var buscador = $("#busqueda").val();
        alert(buscador);
        cargarPublicaciones(tipo, especie, raza, barrio,buscador);
    });
    $("#quitarFiltro").click(function () {
        $("#busqueda").val("");
        $('#comboTiposIndex').prop('selectedIndex', 0);
        $('#comboEspeciesIndex').prop('selectedIndex', 0);
        $('#comboRazasIndex').html("");
        $('#comboRazasIndex').append("<option>Seleccione una raza</option>");
        $('#comboBarriosIndex').prop('selectedIndex', 0);
        cargarPublicaciones("", "", "", "","");
    });
    $("#comboEspeciesIndex").change(llenarComboRazasIndex);

});


var paginaActual = 0;

function cargarPublicaciones(tipo, especie, raza, barrio, buscador) {
    $.ajax({
        url: "paginaPublicaciones.php?pagina=" + paginaActual + "&tipo=" + tipo + "&especie=" + especie + "&raza=" + raza + "&barrio=" + barrio+"&buscador="+buscador,
        dataType: 'html',
        type: "get",
        data: {pagina: paginaActual, tipo: tipo, especie: especie, raza: raza, barrio: barrio, buscador:buscador}
    }).done(function (html) {
        $("#contenido").html(html);

        $("#siguiente").click(function () {
            paginaActual += 1;
            cargarPublicaciones(tipo, especie, raza, barrio,buscador);
        });

        $("#anterior").click(function () {
            paginaActual -= 1;
            cargarPublicaciones(tipo, especie, raza, barrio,buscador);
        });

    });
}

function llenarComboRazasIndex() {
    var especie = $("#comboEspeciesIndex").val();
    $.ajax({
        url: "request.php?esp=" + especie,
        dataType: 'html',
        type: "get"

    }).done(function (html) {
        $("#comboRazasIndex").html(html);
    });

}


