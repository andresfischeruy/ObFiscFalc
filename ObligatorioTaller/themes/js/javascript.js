$(document).ready(function () {

    $('#myCarousel').carousel({
        interval: 4000
    })

    $('.subMenu > a').click(function (e)
    {
        e.preventDefault();
        var subMenu = $(this).siblings('ul');
        var li = $(this).parents('li');
        var subMenus = $('#sidebar li.subMenu ul');
        var subMenus_parents = $('#sidebar li.subMenu');
        if (li.hasClass('open'))
        {
            if (($(window).width() > 768) || ($(window).width() < 479)) {
                subMenu.slideUp();
            } else {
                subMenu.fadeOut(250);
            }
            li.removeClass('open');
        } else
        {
            if (($(window).width() > 768) || ($(window).width() < 479)) {
                subMenus.slideUp();
                subMenu.slideDown();
            } else {
                subMenus.fadeOut(250);
                subMenu.fadeIn(250);
            }
            subMenus_parents.removeClass('open');
            li.addClass('open');
        }
    });
    var ul = $('#sidebar > ul');
    $('#sidebar > a').click(function (e)
    {
        e.preventDefault();
        var sidebar = $('#sidebar');
        if (sidebar.hasClass('open'))
        {
            sidebar.removeClass('open');
            ul.slideUp(250);
        } else
        {
            sidebar.addClass('open');
            ul.slideDown(250);
        }
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

