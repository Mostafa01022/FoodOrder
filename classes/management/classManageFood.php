<?php

class manageFood extends connection
{
    public function displayFoods(int $limit = 5, int $page = 1)
    {
        $offset = ($page - 1) * $limit;
        $result = $this->conn->query("SELECT * FROM tbl_food limit $limit offset $offset");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
    public function foodCount()
    {
        $result = $this->conn->query("SELECT * FROM tbl_food");
        return $result->num_rows;
    }


    public function addFood($file, $post)
    {
        $title = mysqli_real_escape_string($this->conn, $post['title']);
        $price = mysqli_real_escape_string($this->conn, $post['price']);
        $description = mysqli_real_escape_string($this->conn, $post['description']);
        $category = mysqli_real_escape_string($this->conn, $post['category']);
        $featured = mysqli_real_escape_string($this->conn, $post['featured']);
        $active = mysqli_real_escape_string($this->conn, $post['active']);

        $fileTempPath = $file['image']['tmp_name'];
        $fileName = $file['image']['name'];
        $imageExtention = explode('.', $fileName);
        $imageExtention = strtolower(end($imageExtention));
        $newFileName = "food_" . rand(000, 9999) . '.' . $imageExtention;
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'jfif'];

        if (in_array($imageExtention, $allowedExt)) {
            $destFilePath =  $_SERVER['DOCUMENT_ROOT'] . '/php.course/food-order/images/food/' . $newFileName;

            if (move_uploaded_file($fileTempPath, $destFilePath)) {
                $result = $this->conn->query("INSERT INTO tbl_food 
                        (title,description,price,image_name,category_id,featured,active) 
                        VALUES
                        ('$title','$description','$price','$newFileName','$category','$featured','$active') ");

                if ($result == true) {
                    return $result = ['success' => true, 'data' => [
                        "id" => $this->conn->insert_id,
                        "title" => $title,
                        "description" => $description,
                        "price" => $price,
                        "image_name" => $newFileName,
                        "featured" => $featured,
                        "active" => $active
                    ], 'message' => "<div class='success'>Added Successfully</div>"];
                } else {
                    return $result = ['success' => false,  'message' => "<div class='success'>Not Added </div>"];
                }
            }
        } else {
            return $result = ['success' => false, 'error' => 'invalidExt',  'message' => "<div class='success'>Not Added </div>"];
        }
    }
    public function updateFood($file, $post, $id)
    {
        $title = mysqli_real_escape_string($this->conn, $post['title']);
        $price = mysqli_real_escape_string($this->conn, $post['price']);
        $description = mysqli_real_escape_string($this->conn, $post['description']);
        $category = mysqli_real_escape_string($this->conn, $post['category']);
        $featured = mysqli_real_escape_string($this->conn, $post['featured']);
        $active = mysqli_real_escape_string($this->conn, $post['active']);

        $fileTempPath = $file['image']['tmp_name'];
        $fileName = $file['image']['name'];
        $imageExtention = explode('.', $fileName);
        $imageExtention = strtolower(end($imageExtention));
        $newFileName = "food_" . rand(000, 9999) . '.' . $imageExtention;
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'jfif'];

        if (in_array($imageExtention, $allowedExt)) {
            $destFilePath =  $_SERVER['DOCUMENT_ROOT'] . '/php.course/food-order/images/food/' . $newFileName;

            if (move_uploaded_file($fileTempPath, $destFilePath)) {

                $result = $this->conn->query("UPDATE tbl_food SET 
                title='$title',
                description='$description',
                price=$price,
                image_name='$newFileName',
                category_id=$category,
                featured='$featured',
                active='$active'
                where id=$id ");

                if ($result == true) {
                    return $result = ['success' => true, 'data' => [
                        "title" => $title,
                        "description" => $description,
                        "price" => $price,
                        "image_name" => $newFileName,
                        "featured" => $featured,
                        "active" => $active
                    ], 'message' => "<div class='success'>UPDATED Successfully</div>"];
                } else {
                    return $result = ['success' => false,  'message' => "<div class='success'>Not UPDATED </div>"];
                }
            }
        } else {
            return $result = ['success' => false, 'error' => 'invalidExt',  'message' => "<div class='success'>NOT UPDATED </div>"];
        }
    }

    public function deleteimage($image_name)
    {
        unlink('../../images/food/' . $image_name);
    }

    public function deleteFood($id)
    {
        $delete = $this->conn->query("DELETE FROM tbl_food where id =$id");

        if ($delete == true) {
            return ['success' => true, 'message' => "<div class='success'>Food Deleted Successfully</div>"];
            //echo "deleted";
        } else {
            //echo "not deleted";
            return ['success' => false, 'message' => "<div class='error'>Failed To Delete Food .Try Later .</div>"];
        }
    }

    public function displayFoodById($id)
    {
        $result = $this->conn->query("SELECT * FROM tbl_food WHERE id =$id");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row) {
                return $result = ['success' => true, 'message' => "<div class='success'>id is found</div>", 'data' => $row];
            } else {
                return $result = ['success' => false, 'message' => "<div class='success'>id not found</div>"];
            }
        }
    }
}
