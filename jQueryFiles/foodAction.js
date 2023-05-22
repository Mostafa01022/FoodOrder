
//////====ADD Food ====////

$(document).on("click", "#add_btn", function() {
    $("#addFoodPopup").show();
    $(".tbl-full").hide();
    $("#add_btn").hide();

    $("#closeAddForm").on("click", function() {
        $("#addFoodPopup").hide();
        $(".tbl-full").show();
        $("#add_btn").show();
    });
    $("#addFoodForm").on("submit", function(e) {
        e.preventDefault();

        $.ajax({
            url: 'foodActions.php',
            method: 'post',
            data: new FormData(this),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(result, status) {
                console.log(result);
                console.log(status);
                $("#addFoodPopup").hide();
                $(".tbl-full").show();
                $("#add_btn").show();
                $("#action_message").html(result.message);
                $("#addFoodForm")[0].reset();
                $(".tbl-full tbody").append(` <tr id="food_row_${result.data.id}">
                <td><?= $sn++; ?></td>
                <td>${result.data.title}</td>
                <td style="width: 30%;">${result.data.description}</td>
                <td>$${result.data.price}.00 </td>
                <td> <img src='../../images/food/${result.data.image_name}' width="100px"></td>
                <td>${result.data.featured}</td>
                <td>${result.data.active}</td>
                <td>
                    <button value="${result.data.id}" image_name="${result.data.image_name}" id="update_btn"><img title="Update" style=" padding:10px;" src="http://localhost/php.course/food-order/images/website/update.png" /></button>
                    <button value="${result.data.id} ?>" image_name="${result.data.image_name}" id="delete_food_btn"><img title="Delete" style=" padding:10px;" src="http://localhost/php.course/food-order/images/website/delete.png" /></button>
                </td>
            </tr>`)

            },
            error: function(xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        })
    });
});
//////====UPDATE FOOD ====////

$(document).on("click", "#update_btn", function() {
    
    $.ajax({
        url: 'foodActions.php',
        method: 'get',
        data: {
            update_id : $("#update_btn").val(),
        },
        dataType: 'json',
        success: function(result, status) {
            console.log(result);
            console.log(status);
            $("#update_id").val(result.data.id);
            $("#old_image").val(result.data.image_name);
        }
    });
    $("#updateFoodPopup").show();
    $(".tbl-full").hide();
    $("#add_btn").hide();
    
    $("#closeUpdateForm").on("click", function() {
        $("#updateFoodPopup").hide();
        $(".tbl-full").show();
        $("#add_btn").show();
    });
    $("#updateFoodForm").on("submit", function(e) {

        e.preventDefault();
        let id = $("#update_id").val();
        let trRow = $("#food_row_"+id);


        $.ajax({
            url: 'foodActions.php',
            method: 'post',
            data: new FormData(this),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(result, status) {
                console.log(result);
                console.log(status);
                $("#updateFoodPopup").hide();
                $(".tbl-full").show();
                $("#add_btn").show();
                $("#action_message").html(result.message);
                $("#updateFoodForm")[0].reset();
                trRow.find(".food_title").html(result.data.title);
                trRow.find(".food_image").html("<img src='../../images/food/" + result.data.image_name + "' width='100px'>");
                trRow.find(".food_featured").html(result.data.featured);
                trRow.find(".food_active").html(result.data.active);
                trRow.find(".food_price").html(result.data.price);
                trRow.find(".food_description").html(result.data.description);

            },
            error: function(xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        })
    });
});


///====DELETE food====////


$(document).on("click", "#delete_food_btn", function() {
    let btn = $(this);
    $.ajax({
        url: "foodActions.php",
        method: "get",
        data: {
            delete_id: btn.val(),
            image_name: btn.attr("image_name"),
        },
        dataType: "json",
        success: function(result, status) {
            if (result.success == true) {
                console.log(result);
                console.log(status);
                $("#action_message").html(result.message);
                btn.closest("tr").remove();
            }
        },
        error: function(result, status) {
            if (result.success == true) {
                console.log(result);
                console.log(status);
            }
        }
    });   

});

//====search======////

$(document).ready(function() {
    $(".search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".mytable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});