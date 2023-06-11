<html>

<head>
    <title>login FoodOrder Website</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="login" id="div">
        <h1>Login</h1>
        <br>
        <br>
        <div id="error_div" class='error'></div>
        <form method="post" id="login_form">
            <div class="inputs">
                <br>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter username" required>

                <br><br>

                <label for="password">Password</label>
                <input type="text" name="password" id="password" placeholder="Enter password" required>

                <br><br>

                <button type="submit" name="submit" class="btn-secondary">Login</button>
                <button type="button" class="btn-secondary add_user_btn">Add User</button>
            </div>
        </form>
        <br>
        <p>Created By - <a href="https://www.facebook.com/profile.php?id=100036684104751" target="_blank"> Mostafa Ramadan</a></p>
    </div>
    <div class="popup login">
        <h1>Add User</h1>
        <br>
        <br>
        <form method="post" id="add_user_form">
            <div class="inputs">
                <br>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter username" >

                <br><br>

                <label for="password">Password</label>
                <input type="text" name="user_password" class="user_password" placeholder="Enter password" >

                <br><br>
                <label for="password">Confirm Password</label>
                <input type="text" name="confirm_password" class="confirm_password" placeholder="Confirm password" >
                <input type="hidden" name="add_action">

                <br><br>

                <button type="submit" id="add_user" class="btn-secondary">Add</button>
                <button type="submit" id="close" class="btn-secondary">Close</button>
            </div>
        </form>
        <br>
        <p>Created By - <a href="https://www.facebook.com/profile.php?id=100036684104751" target="_blank"> Mostafa Ramadan</a></p>
    </div>

</body>
<script src="jsFiles/jquery.min.js"></script>
<script src="jsFiles/login.js"></script>
<script src="jsFiles/addUser.js"></script>

</html>