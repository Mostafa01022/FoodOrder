<?php

class food extends Database
{

    // function to display food data by id

    public function displayFoodById($id)
    {
        $result = $this->conn->query("SELECT * FROM tbl_food WHERE id =$id");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }
    // function to display food data active='yes' and featured ='yes'

    public function displayFoodByActive_Featured()
    {
        $result = $this->conn->query("SELECT*FROM tbl_food WHERE active ='yes' AND featured='yes' limit 6");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }

    // function to display food data 

    public function displayAllFoods()
    {
        $result = $this->conn->query("SELECT*FROM tbl_food WHERE active ='yes'");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }



    // function to display category foods 

    public function displayCategor_Foods($catgory_id)
    {
        $result = $this->conn->query("SELECT*FROM tbl_food WHERE category_id =$catgory_id");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
}
