<?php

namespace Management;
use Database;

class ManageAdmins extends Database
{

    public function showAdmins()
    {
        $result = $this->conn->query("SELECT*FROM tbl_admin");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $adminData[] = $row;
            }
            return $adminData;
        }
    }
    public function showAdminsById($id)
    {
        $result = $this->conn->query("SELECT*FROM tbl_admin WHERE id=$id");
        if ($result->num_rows > 0) {
            $adminData = $result->fetch_assoc();
            if ($adminData) {
                return $result = ['success' => true, 'message' => "<div class='success'>id is found</div>", 'data' => $adminData];
            } else {
                return $result = ['success' => false, 'message' => "<div class='success'>id not found</div>"];
            }
        }
    }

    public function deleteAdmin($id)
    {

        $result = $this->conn->query("DELETE FROM tbl_admin where id ='$id'");

        if ($result) {
            return $result = ['success' => true, 'message' => "<div class='success'>Admin Deleted Successfully</div>"];
        } else {
            return $result = ['success' => false, 'message' => "<div class='success'>Failed To Delete Admin .Try Later .</div>"];
        }
    }

    public function updateAdmin($post)
    {
        $id = mysqli_real_escape_string($this->conn, $post["id"]);
        $full_name   = mysqli_real_escape_string($this->conn, $post['full_name']);
        $username    = mysqli_real_escape_string($this->conn, $post['username']);

        $result = $this->conn->query("UPDATE tbl_admin SET 
            full_name='$full_name',
            username='$username'
            where id=$id ");
        if ($result == true) {
            return $result = ['success' => true, 'data' => [
                'full_name' => $full_name,
                'username' => $username
            ], 'message' => "<div class='success'>Admin Updated Successfully</div>"];
        } else {
            return $result = ['success' => false, 'message' => "<div class='error'>Failed To Update Admin .Try Later .</div>"];
        }
    }



    public function changePassword($post)
    {
        $id = mysqli_real_escape_string($this->conn, $post['id']);
        $current_password = mysqli_real_escape_string($this->conn, md5(($post['current_password'])));
        $new_password = mysqli_real_escape_string($this->conn, md5(($post['new_password'])));
        $confirm_password = mysqli_real_escape_string($this->conn, md5(($post['confirm_password'])));

        $data = $this->conn->query("SELECT*FROM tbl_admin where id='$id' and password='$current_password'");
        if ($data->num_rows > 0) {
            if ($new_password == $confirm_password) {
                $result = $this->conn->query("UPDATE tbl_admin set password='$new_password' where id='$id'");
                if ($result) {
                    return $result = ['success' => true, 'message' => "<div class='success'>Password Updated Successfully.</div>"];
                } else {
                    return $result = ['success' => false, 'message' => "<div class='error'>Failed To change password .Try Later .</div>"];
                }
            }
        } else {
            return $result = ['success' => false, 'message' => "<div class='error'>current password is not true .</div>"];
        }
    }

    public function addAdmin($post)
    {
        $fullName   = mysqli_real_escape_string($this->conn, $post['fullName']);
        $username    = mysqli_real_escape_string($this->conn, $post['username']);
        $password    = mysqli_real_escape_string($this->conn, md5(($post['password'])));

        $result = $this->conn->query("INSERT INTO tbl_admin (full_name,username,password) 
            VALUES('$fullName','$username','$password') ");
        if ($result == true) {
            return $result = ['success' => true, 'data' => ['full_name' => $fullName, 'username' => $username, 'id' => $this->conn->insert_id], 'message' => "<div class='success'>Added Successfully</div>"];
        } else {
            return $result = ['success' => false, 'message' => "<div class='success'>Not Added </div>"];
        }
    }
}
