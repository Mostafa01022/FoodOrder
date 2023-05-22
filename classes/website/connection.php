<?php

session_start();


/*
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');


        $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(mysqli_error(  $mysqli ));

        


*/

class connection{

    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'food-order';
    public $conn;


    function __construct(){
        $this->conn = new mysqli ($this->servername,$this->username,$this->password,$this->dbname);

        if($this->conn->connect_error){
            echo "failed to connect";
        }else{
            //echo "connected";
            return $this->conn ;
        }
    }
}