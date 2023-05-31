$("#login_form").on("submit", function () {
    $.ajax({
        url: "login_submit.php",
        method: "post",
        data: {
            username: $("#username").val(),
            password: $("#password").val(),
        },
        dataType: "json",
        success: function (result) {
            if (result.success == true) {
                // redirect home page
                window.location.href = 'http://localhost/php.course/FoodOrder/admin/dashboard/index-p.php';
                $("#action_message").html(result.message)

            } else {
                $("#error_div").html(result.message)
            }
        }
    });

    return false;
})