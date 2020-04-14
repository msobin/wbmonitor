$(function () {
    let addButton = $('#addProduct');

    addButton.on('click', function () {
        let productUrl = $('input[name=productUrl]').val();
        addButton.prop('disabled', true);

        $.ajax({
            url: '/product/add',
            data: {
                url: productUrl,
            },
            success: function (data) {
                if (data.success) {

                } else {

                }

                alert(data.message);
            },
            error: function () {
            },
            complete: function () {
                addButton.prop('disabled', false);
            }
        });
    });
});