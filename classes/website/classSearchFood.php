<?php

class searchedFood extends connection{
    // function to validate inputs

    public function validateInput($conn,$input){
        return mysqli_real_escape_string($conn,$input);
    }

   
    
    // function to display searched foods 

    public function displaySearched_Foods($post){
        $search=mysqli_real_escape_string($this->conn, $post['search']);

        $result = $this->conn->query("SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR  description LIKE '%$search%'");
        if($result->num_rows>0){
            while($row =$result->fetch_assoc()){
                $data[]=$row ;
            }
            return $data ;
        }
    }
}