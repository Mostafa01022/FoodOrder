<?php
class order extends connection{
    
    public function insert_order($post){

        $food=mysqli_real_escape_string($this->conn, $post['title']);
        $price=mysqli_real_escape_string( $this->conn,$post['price']);
        $quantity=mysqli_real_escape_string( $this->conn,$post['quantity']);
    
        $total=$price*$quantity;
    
        $date=date('Y-m-d h:i:s') ;
    
        $status="orderd";
    
        $customer_name=mysqli_real_escape_string( $this->conn,$post['full-name']);
        $customer_contact=mysqli_real_escape_string( $this->conn,$post['contact']);
        $customer_email=mysqli_real_escape_string( $this->conn,$post['email']);
        $customer_address=mysqli_real_escape_string( $this->conn,$post['address']);

        $result = $this->conn->query("INSERT INTO tbl_order SET
        food='$food',
        price='$price',
        quantity='$quantity',
        total='$total',
        order_date='$date',
        status='$status',
        customer_name='$customer_name',
        customer_contact='$customer_contact',
        customer_email='$customer_email',
        customer_address='$customer_address'");
          if( $result){
            $_SESSION['order']="<div class='success text-center'>Food Ordered Successfully.</div>";
           // header("location:http://localhost/php.course/food-order/website-page.php");

            echo '<script>
            window.location.href="website-page.php";
              </script>';
        }else{
          
            $_SESSION['order']="<div class='error text-center'>Fialed To Order Food.</div>";
           // header("location:http://localhost/php.course/food-order/website-page.php");

            echo '<script>
            window.location.href="website-page.php";
              </script>';
        }

    
    }
}