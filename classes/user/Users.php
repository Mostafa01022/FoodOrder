<?php
    
class Users extends Database{
    public function addUser($post)
    {
        $username    = mysqli_real_escape_string($this->conn, $post['username']);
        $password    = mysqli_real_escape_string($this->conn, md5(($post['user_password'])));

        $result = $this->conn->query("INSERT INTO tbl_users (username,password) 
            VALUES('$username','$password') ");
        if ($result == true) {
            return $result = ['success' => true,  'message' => "<div class='success'>Added Successfully</div>"];
        } else {
            return $result = ['success' => false, 'message' => "<div class='error'>Not Added </div>"];
        }
    }
}    