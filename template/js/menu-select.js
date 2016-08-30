$(document).ready(function () {
    $('#slider-range').slider({
        range:true,
        min:10000,
        max:300000,
        values:[10000,300000],
        slide:function (event,ui) {
            $('#min-price').val(ui.values[0]);
            $('#max-price').val(ui.values[1]);
        }
    });
    $('#slider-range').slider({values:[$('#min-price').val(),$('#max-price').val()]})
    $('#slider-range').slider({values:[$('#min-price').val(),$('#max-price').val()]})
    $('#min-price').keyup(function () {
       $('#slider-range').slider({values:[$('#min-price').val(),$('#max-price').val()]})
    });
    $('#max-price').keyup(function () {
        $('#slider-range').slider({values:[$('#min-price').val(),$('#max-price').val()]})
    });
});