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
