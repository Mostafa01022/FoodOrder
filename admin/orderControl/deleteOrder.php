<?php
include("../../classes/management/allClasses.php");

if (isset($_GET['delete_id'])) {
    $orderData = new manageOrder();
    $delete = $orderData->deleteOrder();
}