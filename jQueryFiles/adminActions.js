
$(document).ready(function () {

    //========ADD ADMIN ======////

    $("#add_btn").on("click", function () {
        $("#popupAdd").show();
        $(".tbl-full").toggle();
        $("#add_btn").toggle();
    });
    $("#close_form").on("click", function () {
        $(".tbl-full").toggle();
        $("#add_btn").toggle();
        $("#popupAdd").hide();
        $("#add_form")[0].reset();

    });
    $("#add_form").on("submit", function (e) {
        e.preventDefault();
        
        $.ajax({
            url: 'adminActions.php',
            method: 'post',
            dataType: 'json',
            data: new FormData(this),
            processData: false,
            contentType: false,

            success: function (result, status) {
                if (result.success == true) {
                    console.log(result);
                    console.log(status);
                    $(".tbl-full").toggle();
                    $("#add_btn").toggle();
                    $("#popupAdd").hide();
                    $("#action_message").html(result.message);
                    $("#add_form")[0].reset();
                    $(".tbl-full tbody").append(` <tr id="admin_row_${result.data.id}">
                            <td></td>
                            <td>${result.data.full_name}</td>
                            <td>${result.data.username}</td>
                            <td style=" width:25%;">
                                <button id="update_btn" value="${result.data.id}" class=""><img title="Update" style=" padding:10px;" src="http://localhost/php.course/food-order/images/website/update.png" /></button>
                                <button id="change_btn" value="${result.data.id}" class=""><img title="change password" style=" padding:10px;" src="http://localhost/php.course/food-order/images/website/change.png" /></button>
                                <button id="delete_btn" value="${result.data.id}" class=""><img title="Delete" style=" padding:10px;" src="http://localhost/php.course/food-order/images/website/delete.png" /></button>
                            </td>
                        </tr>`)
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    });
});

//=======DISPLAY UPDATE FORM =====//////

$(document).on("click", "#update_btn", function () {
    let admin_id = $(this).val();
    // alert(id);
    $("#updateUser").show();
    $(".tbl-full").hide();
    $("#add_btn").hide();
    
    $("#close_update").on("click", function () {
        
        $(".tbl-full").show();
        $("#add_btn").show();
        $("#updateUser").hide();
    });
    
    $.ajax({
        method: 'get',
        url: 'adminActions.php',
        data: {
            id: admin_id
        },
        dataType: 'json',
        success: function (result, status) {
            if (result.success == true) {
                console.log(result);
                console.log(status);
                $("#updateFullName").val(result.data.full_name);
                $("#updateUsername").val(result.data.username);
                $("#updateId").val(result.data.id);
            }
        }
    });

    //==== UPDATE ACTION ======////

    $("#update_admin").on("click", function (e) {
        let id = $("#updateId").val();
        let trRow = $("#admin_row_"+id);

        e.preventDefault();
        if ($('#updateFullName').val() == '' || $('#updateUsername').val() == '') {
            alert("please , fill in all fields.");
        } else {
            $.ajax({
                method: 'post',
                url: 'adminActions.php',
                dataType: 'json',
                data: {
                    full_name: $("#updateFullName").val(),
                    username: $("#updateUsername").val(),
                    id: $("#updateId").val()
                },
                success: function (result, status) {
                    if (result.success == true) {
                        console.log(result);
                        console.log(status);
                        $("#updateUser").hide();
                        $(".tbl-full").show();
                        $("#add_btn").show();
                        $("#action_message").html(result.message);
                        trRow.find(".admin_full_name").html(result.data.full_name);
                        trRow.find(".admin_username").html(result.data.username);
                    } else {
                        console.log(result);
                        console.log(status);
                    }
                }
            });
        }
    });
});


//=== CHANGE PASSWORD ====///

$(document).on("click", "#change_btn", function () {
    let change_id = $(this).val();
    //alert(oldPassword);
    $("#changePassForm").show();
    $(".tbl-full").hide();
    $("#add_btn").hide();

    $("#change_close").on("click", function () {
        $("#changePassForm").hide();
        $(".tbl-full").show();
        $("#add_btn").show();
        $("#change_form")[0].reset();

    });
    $("#change_submit").on("click", function (e) {
        e.preventDefault();
        if ($('#current_password').val() == '' || $('#new_password').val() == '' || $('#confirm_password').val() == '') {
            alert("please , fill in all fields.");
        } else {
            if ($('#new_password').val() !== $('#confirm_password').val()) {
                alert("password must be the same.");
            } else {
                $.ajax({
                    method: 'post',
                    url: 'adminActions.php',
                    dataType: 'json',
                    data: {
                        current_password: $("#current_password").val(),
                        new_password: $("#new_password").val(),
                        confirm_password: $("#confirm_password").val(),
                        id: change_id
                    },
                    success: function (result, status) {
                        if (result.success == true) {
                            console.log(result);
                            console.log(status);
                            $("#changePassForm").hide();
                            $(".tbl-full").show();
                            $("#add_btn").show();
                            $("#action_message").html(result.message);
                            $("#change_form")[0].reset();

                        } else {
                            console.log(result);
                            console.log(status);
                            alert("current password is not true")
                        }
                    }
                });
            }
        }
    });
});


//=== DELETE ADMIN ===///

$(document).on("click", "#delete_btn", function () {
    let btn = $(this);

    $.ajax({
        method: 'get',
        dataType: 'json',
        url: 'adminActions.php',
        data: {
            delete_id: $("#delete_btn").val()
        },
        success: function (result, status) {
            if (result.success == true) {
                console.log(result);
                console.log(status);
                btn.closest("tr").remove();
                $("#action_message").html(result.message)
            } else {
                console.log(result);
                console.log(status);
            }
        }
    });
});

//====search======////

$(document).ready(function () {
    $(".search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".mytable tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});