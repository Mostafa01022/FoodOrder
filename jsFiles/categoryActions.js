
//////====ADD CATEGORY ====////
$(document).ready(function () {

    $("#add_btn").on("click", function () {
        $("#addCatPopup").show();
        $(".tbl-full").hide();
        $("#add_btn").hide();
    });
    $("#closeAddForm").on("click", function () {
        $("#addCatPopup").hide();
        $(".tbl-full").show();
        $("#add_btn").show();
    });
    $("#addCatForm").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: 'categoryActions.php',
            method: 'post',
            data: new FormData(this),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (result, status) {
                console.log(result);
                console.log(status);
                $("#addCatPopup").hide();
                $(".tbl-full").show();
                $("#add_btn").show();
                $("#action_message").html(result.message);
                $("#addCatForm")[0].reset();
                $(".tbl-full tbody").append(` <tr id="category_row_${result.data.id}">
            <td></td>
            <td class="category_title">${result.data.title}</td>
            <td  class="category_img">
                    <img src='../../images/category/${result.data.image_name}' width="100px">
            </td>
            <td class="category_featured">${result.data.featured}</td>
            <td class="category_active">${result.data.active}</td>
            <td style="width: 15%; padding:25px;">
                <button value='${result.data.id}' class="update_btn_class">
                    <img title="Update" src="http://localhost/php.course/FoodOrder/images/website/update.png" /></button>
                <button value='${result.data.id}' data-image_name=${result.data.image_name} class="delete_category_btn">
                    <img title="Delete" src="http://localhost/php.course/FoodOrder/images/website/delete.png" />
                </button>
            </td>
        </tr>`);
            },

            error: function (xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        })
    });

    //====UPDATE====////

    $(document).on("click", ".update_btn_class", function () {
        let cat_id = $(this).val();
        $.ajax({
            method: 'get',
            url: 'categoryActions.php',
            data: {
                update_id: cat_id
            },
            dataType: 'json',
            success: function (result, status) {
                if (result.success == true) {
                    console.log(status);
                    $("#update_title").val(result.data.title);
                    $("#update_id").val(result.data.id);
                    $("#old_image").val(result.data.image_name);
                }
            }
        });

        $("#updateCatPopup").show();
        $(".tbl-full").hide();
        $("#add_btn").hide();
    });
    
    $("#closeUpdateForm").on("click", function () {

        $(".tbl-full").show();
        $("#add_btn").show();
        $("#updateCatPopup").hide();
    });


    $("#updateCatForm").on("submit", function (e) {
        e.preventDefault();
        let id = $("#update_id").val();
        let trRow = $("#category_row_" + id);
        $.ajax({
            url: 'categoryActions.php',
            method: 'post',
            data: new FormData(this),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (result, status) {
                $("#updateCatPopup").hide();
                $(".tbl-full").show();
                $("#add_btn").show();
                $("#action_message").html(result.message);
                trRow.find(".category_title").html(result.data.title);
                trRow.find(".category_img").html("<img src='../../images/category/" + result.data.image_name + "' width='100px'>");
                trRow.find(".category_featured").html(result.data.featured);
                trRow.find(".category_active").html(result.data.active);
            },
            error: function (xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    });


    ///====DELETE CATEGORY====////


    $(document).on("click", ".delete_category_btn", function () {
        let btn = $(this);
        $.ajax({
            url: "categoryActions.php",
            method: "get",
            data: {
                delete_id: btn.val(),
                image_name: btn.attr("data-image_name"),
            },
            dataType: "json",
            success: function (result, status) {
                if (result.success == true) {
                    console.log(result);
                    console.log(status);
                    $("#action_message").html(result.message)
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


    //====search======////

    $(".search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".mytable tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});