<?php

session_start();
include __DIR__."../../../config/Database.php";
include __DIR__."../../../classes/login/checkAdmin.php";

if(isset($_POST['username']) and isset($_POST['password'])){

    $login = new checkAdmin();
    echo json_encode($login->check_admin($_POST));
}
?>