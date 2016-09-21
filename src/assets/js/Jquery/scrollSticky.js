$(document).ready(function() {
    $('#menu-button').on('click', function() {
        $('.burgerMenu').toggleClass('menu-open');
    });
    $('nav li').on('click', function() {
        $('.burgerMenu').toggleClass('menu-open');
    });
});


if ($(window).width() > 640) {
    $('.filterRight').css('display', 'block');
}
$(window).resize(function() {
    if ($(window).width() > 640) {
        $('.filterRight').css('display', 'block');
    };
});

$(document).ready(function() {
    $(function() {
        var nav = $('.filterMain');
        if (nav.length) {
            var stickyNavTop = nav.offset().top + 4;
            $(window).scroll(function() {
                if ($(window).scrollTop() > stickyNavTop && screen.width > 640) {
                    $('.filterMain').addClass('sticktotop');
                    $('.cardPage').addClass('marginToFix');
                } else {
                    $('.filterMain').removeClass('sticktotop');
                    $('.cardPage').removeClass('marginToFix');
                }
            });
        }
    });
});
