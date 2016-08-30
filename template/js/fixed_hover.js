$(document).ready(function () {
    $('.sub-menu a[data-category]').mouseover(function () {
        var categoryId=$(this).attr('data-category');
        $('.menu-products-anchor[data-category='+categoryId+']').attr('id','hover-item');
    }).mouseout(function () {
        var categoryId=$(this).attr('data-category');
        $('.menu-products-anchor[data-category='+categoryId+']').removeAttr('id','hover-item');
    });
});