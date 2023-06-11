$("#login_form").on("submit", function () {
  $.ajax({
    url: "admin/access/login_submit.php",
    method: "post",
    data: {
      username: $("#username").val(),
      password: $("#password").val(),
    },
    dataType: "json",
    success: function (result) {
      if (result.success == true && result.identity === "admin") {
        // redirect home page
        window.location.href =
          "http://localhost/php.course/FoodOrder/admin/dashboard/index-p.php";
      } else {
        if (result.success == true && result.identity === "user") {
          window.location.href =
            "http://localhost/php.course/FoodOrder/website/website-page.php";
        } else {
          $("#error_div").html(result.message);
        }
      }
    },
  });
  return false;
});
