<?php

session_start();

include __DIR__ . "../../../vendor/autoload.php";

use Management\ManageOrder;

$manageOrder = new ManageOrder();

if (isset($_POST['delete_id'])) {

    echo json_encode($manageOrder->deleteOrder($_POST['delete_id']));
    die;
}
if (isset($_GET['update_id'])) {

    echo json_encode($manageOrder->displayOrdersById($_GET['update_id']));
    die;
}
if (isset($_POST['update_order']) and isset($_POST['update_id'])) {

    echo json_encode($manageOrder->updateOrder($_POST['update_id']));
    die;
}
