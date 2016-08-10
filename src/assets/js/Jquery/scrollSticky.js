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
  $('#burger-open').click(function(){
    $('.burger-menu').toggleClass('open closed');
  });
  $('#burger-close').click(function(){
    $('.burger-menu').toggleClass('open closed');
  });
  $('.burger-menu').find('a').click(function(){
    $('.burger-menu').toggleClass('open closed');
  });
  $(window).resize(function(){
    if($(window).width() > 736 && $('.burger-menu').hasClass('open')){
      $('.burger-menu').toggleClass('open closed');
    };
  });
});
