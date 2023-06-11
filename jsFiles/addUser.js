$(document).ready(function () {
  $(".add_user_btn").on("click", function () {
    $("#div").hide();
    $(".popup").show();
  });

  $("#close").on("click", function () {
    $(".popup").hide();
    $("#div").show();
  });

  $("#add_user_form").on("submit", function (e) {
    e.preventDefault();

    if ($(".user_password").val() !== $(".confirm_password").val()) {
      alert("passwords are different .");
    } else {
      $.ajax({
        url: "admin/access/addUser.php",
        method: "post",
        dataType: "json",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (result) {
          $(".popup").hide();
          $("#div").show();
          $("#error_div").html(result.message);
          $("#error_div").html(result.empty_username);
          $("#error_div").html(result.empty_password);
          $("#add_user_form")[0].reset();
        },
      });
    }
  });
});
