
<?php

session_start();
include __DIR__ . "../../../config/Database.php";
include __DIR__ . "../../../classes/management/classManageFood.php";

$manageFood = new manageFood();

//ADD CAT 
if (isset($_POST['add_food'])) {

    echo json_encode($manageFood->addFood($_FILES, $_POST));
    die;
}

//====UPDATE===//

if (isset($_GET['update_id'])) {

    echo json_encode($manageFood->displayFoodById($_GET['update_id']));
    die;
}


if (isset($_POST['old_image']) and  isset($_POST['update_id'])) {

    $image = $manageFood->deleteimage($_POST['old_image']);
    echo json_encode($manageFood->updateFood($_FILES, $_POST, $_POST['update_id']));
    die;
}

//===DELETE=////

if (isset($_GET['image_name']) and  isset($_GET['delete_id'])) {

    $image = $manageFood->deleteimage($_GET['image_name']);
    echo json_encode($manageFood->deleteFood($_GET['delete_id']));
    die;
}
