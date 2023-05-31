<?php

namespace Management;
use Database;

class ManageOrder extends Database
{
    public function displayOrders(int $limit = 10, int $page = 1)
    {
        $offset = ($page - 1) * $limit;
        $result = $this->conn->query("SELECT * FROM tbl_order LIMIT $limit offset $offset");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
    public function orderCount()
    {
        $result = $this->conn->query("SELECT * FROM tbl_order");
        return $result->num_rows;
    }

    public function renuvue()
    {
        $result = $this->conn->query("SELECT sum(total_price) as renuvue FROM tbl_order WHERE status='delivered'");
        $renuvue = $result->fetch_assoc();
        echo '$' . $renuvue = $renuvue['renuvue'];
    }


    public function displayOrdersById($id)
    {
        $result = $this->conn->query("SELECT*FROM tbl_order WHERE id=$id ");
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data;
        }
    }
    public function deleteOrder($id)
    {

        $result = $this->conn->query("DELETE FROM tbl_order where id = $id");

        if ($result == true) {

            return $result = ['success' => true, 'message' => "<div class='success'>deleted</div>"];
        } else {
            return $result = ['success' => false, 'message' => "<div class='success'>id not found</div>"];
        }
    }

    public function updateOrder($id)
    {
        $total_price = mysqli_real_escape_string($this->conn, $_POST['total_price']);
        $status = mysqli_real_escape_string($this->conn, $_POST['status']);
        $customer_name = mysqli_real_escape_string($this->conn, $_POST['customer_name']);
        $customer_contact = mysqli_real_escape_string($this->conn, $_POST['customer_contact']);
        $customer_email = mysqli_real_escape_string($this->conn, $_POST['customer_email']);
        $customer_address = mysqli_real_escape_string($this->conn, $_POST['customer_address']);

        $result = $this->conn->query("UPDATE tbl_order SET
         status ='$status',
         customer_name='$customer_name',
         customer_contact='$customer_contact',
         customer_email='$customer_email',
         customer_address='$customer_address',
         total_price='$total_price'
 
        where id=$id ");

        if ($result == true) {
            return  [
                'success' => true, 'data' => [
                    'status' => $status,
                    'customer_name' => $customer_name,
                    'customer_contact' => $customer_contact,
                    'customer_email' => $customer_email,
                    'customer_address' => $customer_address,
                    'total_price' => $total_price
                ],
                'message' => "<div class='success'>Order Updated Successfully</div>"
            ];
        } else {
            return  ['success' => false, 'message' => "<div class='error'>Failed To Update Order .Try Later .</div>"];
        }
    }
}
