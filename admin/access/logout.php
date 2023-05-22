<?php 

require_once('../../classes/connection/connection.php');

session_unset();

session_destroy();

header('location:http://localhost/php.course/food-order/admin/access/login.php');



?>