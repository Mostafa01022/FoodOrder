<?php
include_once("../../classes/management/allClasses.php");
$manageAdmins = new manageAdmins();

if (
    isset($_POST['fullName']) && isset($_POST['username'])
    && isset($_POST['password']) && isset($_POST['confirm_pass'])
) {
    echo json_encode($manageAdmins->addAdmin($_POST));
}


if (isset($_GET['id'])) {
    echo json_encode($manageAdmins->showAdminsById($_GET['id']));
}

if (isset($_POST['full_name']) and isset($_POST['username']) and isset($_POST['id'])) {
    echo json_encode($manageAdmins->updateAdmin($_POST));
}

if (
    isset($_POST['id']) and isset($_POST['current_password'])
    and isset($_POST['new_password']) and isset($_POST['confirm_password'])
) {
    echo json_encode($manageAdmins->changePassword($_POST));
}


if (isset($_GET['delete_id'])) {
    echo json_encode($manageAdmins->deleteAdmin($_GET['delete_id']));
}
