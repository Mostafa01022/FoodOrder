<?php

session_start();
include __DIR__ . "../../../config/Database.php";
include __DIR__ . "../../../classes/management/classManageCategory.php";

$manangeCategory = new manangeCategory();
//ADD CAT 

if (isset($_POST['action'])) {

       echo json_encode($manangeCategory->addCategory($_POST, $_FILES));
       die;
}

// DISPLAY UPDATE FORM 

if (isset($_GET['update_id'])) {

       echo json_encode($manangeCategory->displayCategoryById($_GET['update_id']));
       die;
}

if (isset($_POST['update_id'])) {

       $old_image = $manangeCategory->deleteimage($_POST['old_image']);
       echo json_encode($manangeCategory->updateCategory($_POST, $_FILES, $_POST['update_id']));
       die;
}
//DELETE CAT

if (isset($_GET['image_name']) and isset($_GET['delete_id'])) {

       $image = $manangeCategory->deleteimage($_GET['image_name']);
       echo json_encode($manangeCategory->deleteCategory($_GET['delete_id']));
       die;
}
