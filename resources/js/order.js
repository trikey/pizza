$(function () {

    $.ajax({
        url: '/ajax/checkout/validation_rules',
        type: 'GET',
        dataType: 'json'
    }).done(function (rulesData) {
        const rules = rulesData.rules;

        $('#checkout-form').append('<input type="submit" class="auth-btn btn btn-primary" value="Submit"/>');

        $.validator.addMethod('notEmpty', function (value, element) {
            return value === '' || value.trim().length !== 0;
        });

        $.validator.addMethod('checkMask', function (value, element) {
            return /\+\d{1} \(\d{3}\) \d{3}-\d{2}-\d{2}/g.test(value);
        });

        $('#phone').mask('+7 (999) 999-99-99', { autoclear: false });

        const formValidator = $('#checkout-form').validate({
            onsubmit: true,
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            rules: rules,
            submitHandler: function (form) {
                const data = $(form).serialize();
                const error = $('#error-msg');
                error.hide();
                $.ajax({
                    url: '/ajax/checkout',
                    data: data,
                    type: 'POST',
                    dataType: 'json',
                }).done(function (data) {
                    $(form).replaceWith(data.message);
                    $('#cart-count').text(0);
                }).catch(function (data, message) {
                    const responseErrors = data.responseJSON?.errors;
                    if (typeof responseErrors === 'object') {
                        const errorsObj = {};
                        Object.keys(responseErrors).forEach(function (key) {
                            responseErrors[key].forEach(function (errorText) {
                                errorsObj[key] = errorText;
                            })
                        });
                        formValidator.showErrors(errorsObj);
                    } else {
                        $('#error-msg').text(message);
                    }
                });
                return false;
            }
        });
    });

});
