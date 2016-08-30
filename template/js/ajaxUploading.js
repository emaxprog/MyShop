$(document).ready(function () {
    var progress=false;
    var startFrom=3;

    $('#btn-more').click(function () {
        $.ajax({
            url:'/ajax/uploading',
            method:'POST',
            data:{'startFrom':startFrom},
            beforeSend:function () {
                progress=true;
            }}).done(
            function (data) {
                data=jQuery.parseJSON(data);
                if(data.length>0){
                    $.each(data,function (index,product) {
                        $('#blocks').append(
                            '<div class="block">'+
                            '<?php if ('+product.isNew+'): ?>'+
                            '<img src="/template/images/content/Products/new.png" class="new">'+
                            '<?php endif; ?>'+
                            '<a href="/product/<?= '+product.id+'; ?>">'+
                            '<div class="img-product">'+
                            '<img src="<?= Product::getMainImage('+product.image_path+') ?>"'+
                            'alt="Apple MacBook"'+
                            'title="Apple MacBook">'+
                            '</div>'+
                            '<div class="about-product"'+
                            '<ul>'+
                            '<li><?= '+product.name+'; ?></li>'+
                            '<?php if ('+product.old_price+'): ?>'+
                            '<li class="old-price"><?= '+product.old_price+'; ?>руб.</li>'+
                            '<?php endif; ?>'+
                            '<li><?= '+product.price+'; ?> руб.</li>'+
                            '</ul>'+
                            '</div>'+
                            '</a>'+
                            '<div class="button-add-basket">'+
                            '<a href="#" data-id="<?= '+product.id+'; ?>" class="btn-add-to-cart"><i'+
                            'class="fa fa-shopping-cart fa-2x"></i>Добавить в корзину</a>'+
                            '</div>'+
                            '</div>'
                        );
                    });
                    progress=false;

                    startFrom+=3;
                }
            }
        );
    });
});