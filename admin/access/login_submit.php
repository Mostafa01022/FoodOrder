<?php

require_once('../../classes/connection/connection.php');
require_once('../../classes/login/checkAdmin.php');
$login = new checkAdmin();
echo json_encode($login->check_admin($_POST));
?>