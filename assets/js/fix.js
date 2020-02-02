// JavaScript Document

(function($) {
    $(function() {
        var $header = $('header.header');
        $(window).scroll(function() {
            if ($(window).scrollTop() > 50) {
                $header.addClass('fixed');
            } else {
                $header.removeClass('fixed');
            }
        });
    });
})(jQuery);





$(function() {
    var topBtn = $('.fix-contact');
    topBtn.hide();
    //繧ｹ繧ｯ繝ｭ繝ｼ繝ｫ縺�100縺ｫ驕斐＠縺溘ｉ繝懊ち繝ｳ陦ｨ遉ｺ
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            topBtn.fadeIn();
        } else {
            topBtn.fadeOut();
        }
    });
});