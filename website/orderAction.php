<?php

session_start();
include __DIR__ . "../../classes/website/classOrder.php";

if (isset($_POST['confirm_order'])) {
    $order = new order();
    echo json_encode($order->insert_order($_POST));
    die;
}
