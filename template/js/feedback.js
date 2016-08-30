$(document).ready(function () {
    $('#submitbtn').click(function () {
        $('.error').html('');
        var name = $('#name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var message = $('#message').val();

        var error = '';

        if (!checkName(name)) {
            error = 'Имя не может быть менее 2-х символов';
            $('.error-name').html('<span>' + error + '</span>');
        }

        if (!checkPhone(phone)) {
            error = 'Некорректный телефон';
            $('.error-phone').html('<span>' + error + '</span>');
        }

        if (!checkEmail(email)) {
            error = 'Некорректный Email';
            $('.error-email').html('<span>' + error + '</span>');
        }

        if (!checkMessage(message)) {
            error = 'Введите сообщение';
            $('.error-message').html('<span>' + error + '</span>');
        }

        if (error == "") {
            $("#popupCheckBox").trigger("click");
            $('.popup-success-wrapper').css('display', 'flex');
            $('.popup-success').html('<span><i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i> Пожалуйста подождите</span>');
            $.ajax({
                type: 'POST',
                url: '/feedback',
                data: $('#feedback-form').serialize(),
                dataType: 'html',
                success: function (data) {
                    $('.popup-success').html('<span>' + data + '</span>');
                    $('.popup-success-wrapper').delay(2000).fadeOut(1000);
                }
            });
        }
    });

    function checkName(name) {
        if (name.length > 2)
            return true
        return false;
    }

    function checkPhone(phone) {
        if (phone.length == 11)
            return true;
        return false;
    }

    function checkEmail(email) {
        if (email.split('@').length > 1 || email.split('.').length > 1)
            return true;
        return false;
    }

    function checkMessage(message) {
        if (message.length != 0)
            return true;
        return false;
    }
});