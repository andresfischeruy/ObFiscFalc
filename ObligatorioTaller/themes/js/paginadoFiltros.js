$(document).ready(function () {
    $("#filtrar").click(function () {
        var tipo = $("#comboTiposIndex").val();
        alert(tipo);
        var especie = $("#comboEspeciesIndex").val();
        alert(especie);
        var raza = $("#comboRazasIndex").val();
        alert(raza);
        var barrio = $("#comboBarriosIndex").val();
        alert(barrio);
        cargarPublicaciones(tipo, especie, raza, barrio)
    });
});

 
var paginaActual = 0;

function cargarPublicaciones(tipo, especie, raza, barrio) {
    $.ajax({
        url: "paginaPublicaciones.php?pagina="+paginaActual+"&tipo="+tipo+"&especie="+especie+"&raza="+raza+"&barrio="+barrio,
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

