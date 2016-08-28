$(document).ready(function() {
    $('#menu-button').on('click', function() {
        $('.burgerMenu').toggleClass('menu-open');
    });
    $('nav li').on('click', function() {
        $('.burgerMenu').toggleClass('menu-open');
    });
});
