<?php

class manageOrder extends connection{
    public function displayOrders(int $limit=10,int $page =0){
        $offset = ($page - 1) * $limit;
        $result = $this->conn->query("SELECT * FROM tbl_order LIMIT $limit offset $offset");
        if($result->num_rows>0){
            while($row =$result->fetch_assoc()){
                $data[]=$row ;
            }
            return $data ;
        }
    }
    public function orderCount(){
        $result = $this->conn->query("SELECT * FROM tbl_order");
        return $result->num_rows;    
    } 
   
    public function renuvue(){
        $result = $this->conn->query("SELECT sum(total) as renuvue FROM tbl_order WHERE status='Delivered'");
        $renuvue = $result->fetch_assoc();
        echo '$'.$renuvue= $renuvue['renuvue'];
    } 
    

    public function displayOrdersById($id){
        $result = $this->conn->query("SELECT*FROM tbl_order WHERE id=$id ");
        if($result->num_rows>0){
            $data = $result->fetch_assoc();
            return $data;
        }
    }
    public function deleteOrder(){
    
        $delete=$this->conn->query("DELETE FROM tbl_order where id =".$_GET['delete_id']."");

        if($delete==true){
            $_SESSION['delete']="<div class='success'>Order Deleted Successfully</div>";   
            //echo "deleted";
        header('location:http://localhost/php.course/food-order/admin/orderControl/manage-order.php');
    }else{
            //echo "not deleted";
        
            $_SESSION['delete']="<div class='error'>Failed To Delete Order .Try Later .</div>";   
            
            header('location:http://localhost/php.course/food-order/admin/orderControl/manage-order.php');
        }

    } 

    public function updateOrder(){
        $id = mysqli_real_escape_string($this->conn, $_POST['id']);
        $price = mysqli_real_escape_string($this->conn, $_POST['price']);
        $quantity = mysqli_real_escape_string($this->conn, $_POST['quantity']);
        $status = mysqli_real_escape_string($this->conn, $_POST['status']);
 
        $total = $price * $quantity;
 
        $customer_name = mysqli_real_escape_string($this->conn, $_POST['name']);
        $customer_contact = mysqli_real_escape_string($this->conn, $_POST['contact']);
        $customer_email = mysqli_real_escape_string($this->conn, $_POST['email']);
        $customer_address = mysqli_real_escape_string($this->conn, $_POST['address']);
 
        $update = $this->conn->query("UPDATE tbl_order SET
         quantity='$quantity',
         total='$total',
         status='$status',
         customer_name='$customer_name',
         customer_contact='$customer_contact',
         customer_email='$customer_email',
         customer_address='$customer_address'
 
        where id=$id ");
 
        if ($update == true) {
               $_SESSION['update'] = "<div class='success text-center'>Ordere Updated Successfully.</div>";
               header("location:http://localhost/php.course/food-order/admin/orderControl/manage-order.php");
 
               // echo '<script> window.location.href="website-page.php"; </script>';
 
        } else {
               $_SESSION['update'] = "<div class='error text-center'>Fialed To Update Order .</div>";
               header("location:http://localhost/php.course/food-order/admin/orderControl/manage-order.php");
 
               // echo '<script> window.location.href="website-page.php"; </script>';
        }
    }
}