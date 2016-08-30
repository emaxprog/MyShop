$(document).ready(function () {
    $('.btn-add-to-cart').click(function () {
        var productId=$(this).attr('data-id');
        $.post('/cart/add/'+productId,{},function (data) {
            $('.quantity-in-cart').html(data);
        });
        return false;
    });
});