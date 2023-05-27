<?php
//require_once('../config/connection.php') ;

session_start();
include __DIR__ . "../../../config/Database.php";
?>

<html>

<head>
    <title>Food Order Website</title>
    <link rel="stylesheet" href="../../css/admin.css">
    <script src="../../jsFiles/jquery.min.js"></script>
</head>

<body>
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="../dashboard/index-p.php">Home</a></li>
                <li><a href="../adminControl/manage-admin.php">Admin</a></li>
                <li><a href="../categoryControl/manage-category.php">Category</a></li>
                <li><a href="../foodControl/manage-food.php">Food</a></li>
                <li><a href="../orderControl/manage-order.php">Order</a></li>
                <li><a href="../access/logout.php">Log Out</a></li>
            </ul>
        </div>
    </div>