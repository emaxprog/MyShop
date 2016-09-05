$(document).ready(function () {
    var progress = false;
    var startFrom = 5;

    $('#btn-more').click(function () {
        $.ajax({
            type: 'POST',
            url: '/uploading',
            data: {"startFrom": startFrom},
            beforeSend: function () {
                progress = true;
            },
            success: function (data) {
                data = jQuery.parseJSON(data);
                if (data.length > 0) {
                    $.each(data, function (index, product) {
                        $('#table-products-ajax').append(
                            '<tr>' +
                            '<td>' + product.product_id + '</td>' +
                            '<td>' + product.code + '</td>' +
                            '<td>' + product.name + '</td>' +
                            '<td>' + product.price + '</td>' +
                            '<td><a href="/admin/product/update/' + product.product_id + '" title="Редактировать"><i class="fa fa-edit fa-lg"></i></a></td>' +
                            '<td><a href="/admin/product/delete/' + product.product_id + '" title="Удалить"><i class="fa fa-trash-o fa-lg"></i></a></td>' +
                            '</tr>'
                        );
                    });
                    progress = false;
                    startFrom += 5;
                }
            }
        });
    });
});