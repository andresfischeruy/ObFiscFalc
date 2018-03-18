$(document).ready(function () {

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
                subMenu.fadeOut();
            }
            li.removeClass('open');
        } else
        {
            if (($(window).width() > 768) || ($(window).width() < 479)) {
                subMenus.slideUp();
                subMenu.slideDown();
            } else {
                subMenus.fadeOut();
                subMenu.fadeIn();
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
            ul.slideUp();
        } else
        {
            sidebar.addClass('open');
            ul.slideDown();
        }
    });
  
});

