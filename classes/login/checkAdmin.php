<?php

class checkAdmin extends Database
{

    // function to check user
    public function check_admin($data)
    {
        $returnData = [];
        $username = mysqli_real_escape_string($this->conn, $data['username']);
        $password = mysqli_real_escape_string($this->conn, md5($data['password']));

        $result = $this->conn->query("SELECT * FROM tbl_admin WHERE 
                    username='$username' and password = '$password' LIMIT 1");
        if ($result->num_rows > 0) {
            $_SESSION['admin'] = $username;
            $returnData['success'] = true;
            $returnData['message'] = "Login Successful.";
        } else {
            $returnData['success'] = false;
            $returnData['message'] = "Invalid username or password.";
        }
        return $returnData;
    }
}
