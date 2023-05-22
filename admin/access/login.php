<html>
    <head>
        <title>login Food-Order Website</title>
        <link rel="stylesheet" href="../../css/login.css">
        <style>
           

        </style>
    </head>
    <body>
        <div class="login">
            <h1>Login</h1>
            <br>
            <br>
          <div id="error_div" class='error'></div>
            <form method="post" id="login_form">
                <div class="inputs">
                    <br>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter username" require>
               
                <br><br>
              
                <label for="password">Password</label>
                <input type="text" name="password" id="password" placeholder="Enter password" require>
             
                <br><br>
                
                <button type="submit" name="submit"  class="btn-secondary">Login</button>
                </div>
            </form>
            <br>
            <p>Created By - <a href="https://www.facebook.com/profile.php?id=100036684104751" target="_blank" > Mostafa Ramadan</a></p>
        </div>

    </body>
</html>
<script src="../../jquery.min.js"></script>
<script>
    $("#login_form").on("submit",function(){
        $.ajax({
            url: "login_submit.php",
            method:"post",
            data:{
                username : $("#username").val(),
                password : $("#password").val(),
            } ,
            dataType:"json",
            success: function(result){
                if(result.success == true){
                    // redirect home page
                    window.location.href = 'http://localhost/php.course/food-order/admin/dashboard/index-p.php';      
                    $("#success_div").html(result.message)

                }else{
                    $("#error_div").html(result.message)
                }
            }});
            
        return false;
        })
</script>