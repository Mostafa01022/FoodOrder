<?php
//require_once('../config/connection.php') ;

require_once('../../classes/management/allClasses.php');
require_once('../../classes/login_check/login-check.php') ;
?>


<html>
    <head>
        <title>Food Order Website</title>
        <link rel="stylesheet" href="../../css/admin.css">
        <script src="../../jQueryFiles/jquery.min.js"></script>

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
