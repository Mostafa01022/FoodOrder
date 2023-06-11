<?php

class CheckIdentity extends Database
{

    // function to check user
    public function check_identity($data)
    {
        $username = mysqli_real_escape_string($this->conn, $data['username']);
        $password = mysqli_real_escape_string($this->conn, md5($data['password']));

        $admin = $this->conn->query("SELECT * FROM tbl_admin WHERE 
                    username='$username' and password = '$password' LIMIT 1");

        $user = $this->conn->query("SELECT * FROM tbl_users WHERE 
                    username='$username' and password = '$password' LIMIT 1");
        if ($admin->num_rows > 0) {
            $_SESSION['admin'] = $username;
            return  [
                'message' => "Login Successful.",
                'success' => true, 'identity' => 'admin'
            ];
        } else {

            if ($user->num_rows > 0) {
                $_SESSION['user'] = $username;
                return [
                    'message' => "Login Successful.",
                    'success' => true, 'identity' => 'user'
                ];
            } else {

                return ['message' => "Invalid username or password.", 'success' => false];
            }
        }
    }
}
