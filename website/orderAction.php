<?php

session_start();

require __DIR__ . "../../vendor/autoload.php";

if (isset($_POST['confirm_order'])) {
    $order = new \Website\Order();
    echo json_encode($order->insert_order($_POST));
    die;
}
