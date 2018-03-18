$(document).ready(function () {

    $('#myCarousel').carousel({
        interval: 4000
    });


    $("#comboEspecies").change(llenarComboRazas);
    $("#comboEspecies").ready(llenarComboRazas);
    $("#comboEspeciesIndex").change(llenarComboRazasIndex);
    $("#comboEspeciesIndex").ready(llenarComboRazasIndex);



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

//en el js
function llenarComboRazasIndex() {
    var especie = document.getElementById("comboEspeciesIndex");
    var especieSeleccionada = especie.options[especie.selectedIndex].id;
    $.ajax({
        url: "request.php?esp=" + especieSeleccionada,
        dataType: 'html'
    }).done(function (html) {
        $("#comboRazasIndex").html(html);
    });

}
