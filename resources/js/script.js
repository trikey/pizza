function addToCart(productId)
{
    $.ajax({
        url: '/ajax/add_to_cart',
        data: {
            product_id: productId,
            quantity: 1,
        },
        type: 'POST',
        dataType: 'json',
    }).done(function (data) {
        $('#cart-count').text(data.count);
    });
}

function getCartItemsCount()
{
    $.ajax({
        url: '/ajax/cart_items_count',
        type: 'GET',
        dataType: 'json',
    }).done(function (data) {
        $('#cart-count').text(data.count);
    });
}

$(function () {
    getCartItemsCount();
    $(document).on('click', '.add-to-cart', function () {
        addToCart($(this).attr('data-product-id'));
        return false;
    });
    $(document).on('click', '.cart-minus', function () {
        $.ajax({
            url: '/ajax/cart/decrease',
            data: {
                id: $(this).attr('data-cart-item-id')
            },
            type: 'POST',
        }).done(function (data) {
            $('#cart-container').html($(data).find('#cart-container').html());
            getCartItemsCount();
        });
    });
    $(document).on('click', '.cart-plus', function () {
        $.ajax({
            url: '/ajax/cart/increase',
            data: {
                id: $(this).attr('data-cart-item-id')
            },
            type: 'POST',
        }).done(function (data) {
            $('#cart-container').html($(data).find('#cart-container').html());
            getCartItemsCount();
        });
    });
});
