
$(document).on("click", ".delete_btn", function () {
    let btn = $(this);
    $.ajax({
        url: "orderActions.php",
        method: "post",
        data: {
            delete_id: btn.attr('delete_id')
        },
        dataType: "json",
        success: function (result, status) {
            if (result.success == true) {
                console.log(result);
                console.log(status);
                $("#action_message").html(result.message);
                btn.closest("tr").remove();
            }
        },
        error: function (result, status) {
            if (result.success == true) {
                console.log(result);
                console.log(status);
            }
        }
    });

});


$(document).on("click", ".update_btn", function () {
    let update_id = $(this).attr('update_id');
    $.ajax({
        method: 'get',
        url: 'orderActions.php',
        data: {
            update_id: update_id
        },
        dataType: 'json',
        success: function (result) {
            $('#updateOrderPopup').show();
            $('#total_price').val(result.total_price);
            $('#order_date').val(result.order_date);
            $('#customer_name').val(result.customer_name);
            $('#customer_contact').val(result.customer_contact);
            $('#customer_email').val(result.customer_email);
            $('#customer_address').val(result.customer_address);
            $('#update_id').val(result.id);
            if (result.status === 'ordered') {
                $('#status').val('ordered')
            } else {
                if (result.status === 'delivered') {
                    $('#status').val('delivered')
                } else {
                    if (result.status === 'cancelled') {
                        $('#status').val('cancelled')
                    } else {
                        if (result.status === 'on delivery') {
                            $('#status').val('on delivery')
                        }
                    }
                }
            }
        }
    });
    $('#closeUpdateForm').on('click', function () {
        $('#updateOrderPopup').hide();
    });
});

$(document).ready(function () {
    $('.updateOrderForm').on('submit', function (e) {
        e.preventDefault();
        let data = new FormData(this);
        let id = $('#update_id').val();
        let trRow = $("#row_" + id);
        $.ajax({
            url: 'orderActions.php',
            method: 'post',
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (result) {
                $('#updateOrderPopup').hide();
                $("#action_message").html(result.message);
                $(".updateOrderForm")[0].reset();
                trRow.find('.total_price').html(result.data.total_price);
                trRow.find('.status').html(result.data.status);
                trRow.find('.customer_name').html(result.data.customer_name);
                trRow.find('.customer_contact').html(result.data.customer_contact);
                trRow.find('.customer_email').html(result.data.customer_email);
                trRow.find('.customer_address').html(result.data.customer_address);
            }
        });
    });

});