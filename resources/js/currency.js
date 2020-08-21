$(function () {
    $(document).on('change', '.currency-selector', function () {
        window.location = '?currency=' + $(this).val();
    });
});
