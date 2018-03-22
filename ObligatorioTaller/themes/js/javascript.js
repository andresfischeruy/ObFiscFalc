$(document).ready(function () {
    $("#comboEspecies").change(llenarComboRazas);
    $("#comboEspecies").ready(llenarComboRazas);
   
    
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

