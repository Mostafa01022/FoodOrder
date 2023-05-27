$(document).ready(function () {
    $("#clear_btn").on("click", function () {
        if ($("#cart_table tbody").find("tr").length > 0) {
            $.ajax({
                method: 'post',
                url: 'CartAction.php',
                data: {
                    clear: '1'
                },
                dataType: 'json',
                success: function () {
                    $("#cartCountItems").html(0);
                    $("#cart_table tbody").html("");
                    $("#total_price").html(0);
                }
            });
        }
    });

    $(".remove_btn").on("click", function () {
        let btn = $(this);
        let food_id = btn.attr('food_id');
        let tr = btn.closest("tr");
        $.ajax({
            method: 'post',
            url: 'CartAction.php',
            data: {
                remove_from_cart: 1,
                food_id: food_id,
            },
            dataType: 'json',
            success: function (result) {
                alert(result.message);
                tr.remove();
                $("#cartCountItems").html(result.cartCountItems)
                recalculateTotalPrice();
            }
        });
    });
});

$("#cartForm").on("submit", function (e) {
    e.preventDefault();
    if ($("#cart_table tbody").find("tr").length > 0) {
        $('.popup').show();

    }

});
$("#orderForm").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
        method: 'post',
        url: 'orderAction.php',
        data: new FormData(this),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (result) {
            alert(result.message);
            window.location.reload();
        },
        error: function (xhr, error) {
            console.log(xhr);
            alert('error');
        }
    });
});
$('#cancel_order').on('click', function () {
    $('.popup').hide();
});

// food_id  food_price food_total_price total_price

$(".food_quantity").on("change", function () {
    let input = $(this);
    let inputTr = input.closest("tr");
    let food_quantity = parseInt(input.val());
    let food_id = input.attr("food_id");
    let food_name = inputTr.find(".food_name").val();
    let food_price = inputTr.find(".food_price").val();
    changeCartItem(inputTr, food_id, food_quantity, food_name, food_price)

});

function recalculateTotalPrice() {
    let total_price = 0;
    $(".food_total_price").each(function () {
        total_price += parseFloat($(this).val());
    });
    $("#total_price").html(total_price)
}

function changeCartItem(inputTr, food_id, food_quantity, food_name, food_price) {
    $.ajax({
        method: 'post',
        url: 'CartAction.php',
        data: {
            add_to_cart: 1,
            food_id: food_id,
            food_quantity: food_quantity,
            food_title: food_name,
            food_price: food_price,
        },
        dataType: "json",
        success: function (result) {
            let food_total_price = food_quantity * food_price;
            inputTr.find(".food_total_price").val(food_total_price);
            recalculateTotalPrice()

        },
        error: function (xhr, error) {
            console.log(xhr);
            alert('error');
        }
    });
}