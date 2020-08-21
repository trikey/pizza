function addToCart(product) {
    $.ajax({
        url: '/ajax/cart/' + product + '/add',
        data: {
            quantity: 1,
        },
        type: 'POST',
        dataType: 'json',
    }).done(function (data) {
        $('#cart-count').text(data.count);
    });
}

function getCartItemsCount() {
    $.ajax({
        url: '/ajax/cart/count',
        type: 'GET',
        dataType: 'json',
    }).done(function (data) {
        $('#cart-count').text(data.count);
    });
}

function updateCart(action, id) {
    $.ajax({
        url: '/ajax/cart/' + id + '/' + action,
        type: 'POST',
    }).done(function (data) {
        $('#cart-container').html($(data).find('#cart-container').html());
        getCartItemsCount();
    });
}

$(function () {
    getCartItemsCount();
    $(document).on('click', '.add-to-cart', function () {
        addToCart($(this).attr('data-product'));
        return false;
    });
    $(document).on('click', '.cart-minus', function () {
        updateCart('decrease', $(this).attr('data-cart-item-id'));
    });
    $(document).on('click', '.cart-plus', function () {
        updateCart('increase', $(this).attr('data-cart-item-id'));
    });
    $(document).on('click', '.hamburger', function () {
        $('#navigation').toggleClass('visible');
    });
    $(document).on('change', '.currency-selector', function () {
        window.location = '?currency=' + $(this).val();
    });
});
