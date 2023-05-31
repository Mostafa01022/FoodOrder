<?php

include __DIR__ . "../../../config/Database.php";

session_start();
session_unset();
session_destroy();

header('location:http://localhost/php.course/FoodOrder/admin/access/login.php');
