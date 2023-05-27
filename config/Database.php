<?php


class Database
{

    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'food-order';
    public $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            echo "failed to connect";
        } else {
            //echo "connected";
            return $this->conn;
        }
    }
}
