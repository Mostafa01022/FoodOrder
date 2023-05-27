$(".addToCartForm").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
        method: 'post',
        url: 'CartAction.php',
        data: new FormData(this),
        processData: false,
        dataType: "json",
        contentType: false,
        success: function (result) {
            $("#cartCountItems").html(result.cartCountItems);
            alert(result.message);

        },
        error: function (xhr, error) {
            console.log(xhr);
            alert('error');
        }
    });
});