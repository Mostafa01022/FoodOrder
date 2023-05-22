<?php


class category extends connection{

    // function to add category 
    public function addCategory(){
      
    }

    // function to display category data by id
        
    public function displayCategoryById($id){
        $result = $this->conn->query("SELECT * FROM tbl_category WHERE id =$id");
        if($result->num_rows>0){
        $row = $result->fetch_assoc();
        return $row ;     
        }
    }


    // function to display category data active='yes'
    
    public function displayCategoryByActive(){
        $result = $this->conn->query("SELECT * FROM tbl_category WHERE active='yes'");
        if($result->num_rows>0){
          while($row = $result->fetch_assoc()){
            $data[] = $row ;
          }
          return $data ;     
        }
    }
   
    // function to display category data active='yes' and featured ='yes'
    
    public function displayCategoryByActive_Featured(){
        $result = $this->conn->query("SELECT * FROM tbl_category WHERE active='yes' AND featured='yes'  LIMIT 3");
        if($result->num_rows>0){
          while($row = $result->fetch_assoc()){
            $data[] = $row ;
          }
          return $data ;     
        }
        }

   
}
?>