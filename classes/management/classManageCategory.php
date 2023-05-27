<?php

class manangeCategory extends Database
{
    protected $tableName = 'tbl_category';

    public function displayCategory(int $limit = 4, int $pageNum = 1)
    {
        $offset = ($pageNum - 1) * $limit;
        $result = $this->conn->query("SELECT * FROM {$this->tableName}  LIMIT $limit OFFSET $offset");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
    public function categoryCount()
    {
        $result = $this->conn->query("SELECT * FROM {$this->tableName}");
        return $result->num_rows;
    }
    public function displayCategoryById($id)
    {
        $result = $this->conn->query("SELECT * FROM {$this->tableName} WHERE id =$id");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row) {
                return $result = ['success' => true, 'message' => "<div class='success'>id is found</div>", 'data' => $row];
            } else {
                return $result = ['success' => false, 'message' => "<div class='success'>id not found</div>"];
            }
        }
    }
    public function displayCategoryByActive()
    {
        $result = $this->conn->query("SELECT * FROM {$this->tableName} WHERE active='yes'");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }


    public function addCategory($post, $file)
    {

        $title = mysqli_real_escape_string($this->conn, $post['title']);
        $active = mysqli_real_escape_string($this->conn, $post['active']);
        $featured = mysqli_real_escape_string($this->conn, $post['featured']);

        $fileTempPath = $file['image']['tmp_name'];
        $fileName = $file['image']['name'];
        $imageExtention = explode('.', $fileName);
        $imageExtention = strtolower(end($imageExtention));
        $newFileName = "food_category_" . rand(000, 9999) . '.' . $imageExtention;
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'jfif'];

        if (in_array($imageExtention, $allowedExt)) {
            $destFilePath =  $_SERVER['DOCUMENT_ROOT'] . '/php.course/food-order/images/category/' . $newFileName;

            if (move_uploaded_file($fileTempPath, $destFilePath)) {
                $result = $this->conn->query("INSERT INTO {$this->tableName} (title,image_name,featured,active) 
                VALUES('$title','$newFileName','$featured','$active') ");
                if ($result == true) {
                    return $result = ['success' => true, 'data' => [
                        "id" => $this->conn->insert_id,
                        "title" => $title,
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
    public function updateCategory($post, $file, $id)
    {

        $title = mysqli_real_escape_string($this->conn, $post['update_title']);
        $active = mysqli_real_escape_string($this->conn, $post['update_active']);
        $featured = mysqli_real_escape_string($this->conn, $post['update_featured']);

        $fileTempPath = $file['new_image']['tmp_name'];
        $fileName = $file['new_image']['name'];
        $imageExtention = explode('.', $fileName);
        $imageExtention = strtolower(end($imageExtention));
        $newFileName = "food_category_" . rand(000, 9999) . '.' . $imageExtention;
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'jfif'];

        if (in_array($imageExtention, $allowedExt)) {
            $destFilePath =  $_SERVER['DOCUMENT_ROOT'] . '/php.course/food-order/images/category/' . $newFileName;

            if (move_uploaded_file($fileTempPath, $destFilePath)) {
                $result = $this->conn->query("UPDATE {$this->tableName} SET 
                title='$title',
                image_name='$newFileName',
                featured='$featured',
                active='$active'
                where id=$id ");

                if ($result == true) {
                    return $result = ['success' => true, 'data' => [
                        "title" => $title,
                        "image_name" => $newFileName,
                        "featured" => $featured,
                        "active" => $active
                    ], 'message' => "<div class='success'>updated Successfully</div>"];
                } else {
                    return $result = ['success' => false,  'message' => "<div class='success'>Not updated </div>"];
                }
            }
        } else {
            return $result = ['success' => false, 'error' => 'invalidExt',  'message' => "<div class='success'>Not updated </div>"];
        }
    }




    public function deleteimage($image_name)
    {
        unlink($_SERVER['DOCUMENT_ROOT'] . '/php.course/food-order/images/category/' . $image_name);
    }

    public function deleteCategory($id)
    {

        $delete = $this->conn->query("DELETE FROM {$this->tableName} where id = $id ");

        if ($delete == true) {
            return ['success' => true, 'message' => "<div class='success'>Category Deleted Successfully</div>"];
            //echo "deleted";
        } else {
            //echo "not deleted";
            return ['success' => false, 'message' => "<div class='error'>Failed To Delete Category .Try Later .</div>"];
        }
    }
}
