$(document).ready(function () {
    $(window).scroll(function () {
        var distanceTop=$('#fixed').offset().top;
        if($(window).scrollTop()>=distanceTop)
            $('.wrapper-menu').attr('id','fixed-menu');
        else
            $('.wrapper-menu').removeAttr('id');
    });
});
