<?php

session_start();

include __DIR__ . "../../../vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_action'])) 
{
    $formData = $_POST;
    $validator = new FormValidator($formData);

    if ($validator->validate()) 
    {
        $login = new Users();
        echo json_encode($login->addUser($_POST));
    } else 
    {
        echo json_encode($validator->getErrors()) ;
    }
}

