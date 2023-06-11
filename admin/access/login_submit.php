<?php

session_start();

include __DIR__ . "../../../vendor/autoload.php";


if (isset($_POST['username']) and isset($_POST['password'])) {

    $login = new CheckIdentity();
    echo json_encode($login->check_identity($_POST));
}


