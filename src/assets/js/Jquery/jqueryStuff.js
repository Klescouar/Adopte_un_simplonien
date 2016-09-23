$(document).ready(function() {
    $('#menu-button').on('click', function() {
        $('.burgerMenu').toggleClass('menu-open');
    });
    $('nav li').on('click', function() {
        $('.burgerMenu').toggleClass('menu-open');
    });

    if ($(window).width() > 640) {
        $('.filterRight').css('display', 'block');
    }
    $(window).resize(function() {
        if ($(window).width() > 640) {
            $('.filterRight').css('display', 'block');
        };
    });
});
