<?php
include_once("../partials/menu.php");

$displayFood = new \Management\ManageFood();

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if (isset($_GET['page']) && $_GET['page'] <= 0) {
    header('location:http://localhost/php.course/FoodOrder/admin/foodControl/manage-food.php');
}
$foodCount = $displayFood->foodCount();
$limit = 3;
$pagesCount = ceil($foodCount / $limit);

$data = $displayFood->displayFoods($limit, $page);

$dataCat = new \Management\ManangeCategory();
$dataCategory = new \Management\ManangeCategory();
$dataCat = $dataCat->displayCategoryByActive();
$dataCategory = $dataCategory->displayCategoryByActive();


?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        </br>
        <div>
            <button id="add_btn" class="btn-primary">Add Food</button>
            <input type="search" placeholder="search ..." class="search">
        </div>
        </br>
        <div id="action_message"></div>
        </br>
        <div style="width: 30%;" class="popup" id="addFoodPopup">
            <form id="addFoodForm" method="post" enctype="multipart/form-data">
                <h1>Add Food</h1>
                <table style="width: 100%;    margin:5px; font-weight:bold;">
                    <tr>
                        <td>Title :</td>
                        <td><input type="text" id="title" name="title" placeholder="Enter Title" required style="padding: 0; margin:0;"></td>
                    </tr>
                    <tr>
                        <td>Price :</td>
                        <td><input type="text" id="price" name="price" placeholder=" Enter Price " required></td>
                    </tr>
                    <tr>
                        <td>Description :</td>
                        <td><textarea rows="5" cols="30" id="description" name="description" placeholder="Description Of Food " required></textarea></td>
                    </tr>
                    <tr>
                        <td>Image :</td>
                        <td>
                            <input type="file" id="image" name="image" required style="padding: 0; margin:0;">
                        </td>
                    </tr>
                    <tr>
                        <td>Category :</td>
                        <td> <select width="30%" id="category" name="category">
                                <?php
                                if ($dataCat == true) {
                                    foreach ($dataCat as $dataCat) {
                                ?>
                                        <option value="<?php echo $dataCat['id'] ?>"><?php echo $dataCat['title'] ?></option>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <option value="0">No Category Found</option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured :</td>
                        <td>
                            Yes<input type="radio" name="featured" id="featured" value="yes" required style="padding: 0; margin:0;">
                            No <input type="radio" name="featured" id="featured" value="no" required style="padding: 0; margin:0;">
                        </td>
                    </tr>
                    <tr>
                        <td>Active :</td>
                        <td>
                            Yes <input type="radio" id="active" name="active" value="yes" required style="padding: 0; margin:0;">
                            No <input type="radio" id="active" name="active" value="no" required style="padding: 0; margin:0;">
                        </td>
                    </tr>
                </table>
                <input type="hidden" value="add_food" name="add_food" class="add-btn">
                <button type="submit" id="addFood_submit" name="add_food" class="add-btn">Add</button>
                <button type="button" name="close" id="closeAddForm" class="close-btn">Close</button>
            </form>
        </div>

        <div style="width: 30%;" class="popup" id="updateFoodPopup">
            <form id="updateFoodForm" method="post" enctype="multipart/form-data">
                <h1>Update Food</h1>
                <table style="width: 100%;    margin:5px; font-weight:bold;">
                    <tr>
                        <td>Title :</td>
                        <td><input type="text" id="update_title" name="title" placeholder="Enter Title" required style="padding: 0; margin:0;"></td>
                    </tr>
                    <tr>
                        <td>Price :</td>
                        <td><input type="text" id="price" name="price" placeholder=" Enter Price " required></td>
                    </tr>
                    <tr>
                        <td>Description :</td>
                        <td><textarea rows="5" cols="30" id="description" name="description" placeholder="Description Of Food " required></textarea></td>
                    </tr>
                    <tr>
                        <td>Image :</td>
                        <td>
                            <input type="file" id="image" name="image" required style="padding: 0; margin:0;">
                        </td>
                    </tr>
                    <tr>
                        <td>Category :</td>
                        <td>
                            <select width="30%" id="category" name="category">
                                <?php
                                if ($dataCategory == true) {
                                    foreach ($dataCategory as $dataCategory) {
                                ?>
                                        <option value="<?php echo $dataCategory['id'] ?>"><?php echo $dataCategory['title'] ?></option>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <option value="0">No Category Found</option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured :</td>
                        <td>
                            Yes<input type="radio" name="featured" id="featured" value="yes" required style="padding: 0; margin:0;">
                            No <input type="radio" name="featured" id="featured" value="no" required style="padding: 0; margin:0;">
                        </td>
                    </tr>
                    <tr>
                        <td>Active :</td>
                        <td>
                            Yes <input type="radio" id="active" name="active" value="yes" required style="padding: 0; margin:0;">
                            No <input type="radio" id="active" name="active" value="no" required style="padding: 0; margin:0;">
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="old_image" id="old_image">
                <input type="hidden" name="update_id" id="update_id">
                <button type="submit" id="update_Food_submit" name="update_food" class="add-btn">Update</button>
                <button type="button" name="close" id="closeUpdateForm" class="close-btn">Close</button>
            </form>
        </div>
        <table class="tbl-full">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Tile</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="mytable">

                <?php
                $sn = 1;
                if ($data != "") {
                    foreach ($data as $value) {
                ?>
                        <tr id="food_row_<?= $value['id'] ?>">
                            <td><?= $sn++; ?></td>
                            <td class="food_title"><?= $value['title']; ?></td>
                            <td class="food_description" style="width: 30%;"><?php echo $value['description']; ?></td>
                            <td class="food_price">$<?= $value['price']; ?>.00 </td>
                            <td class="food_image"> <img src='../../images/food/<?php echo $value['image_name']; ?>' width="100px"></td>
                            <td class="food_featured"><?php echo $value['featured'] ?></td>
                            <td class="food_active"><?php echo $value['active'] ?></td>
                            <td>
                                <button value="<?php echo $value['id']; ?>" image_name="<?php echo $value['image_name']; ?>" class="update_btn"><img title="Update" style=" padding:10px;" src="http://localhost/php.course/FoodOrder/images/website/update.png" /></button>
                                <button value="<?php echo $value['id']; ?>" image_name="<?php echo $value['image_name']; ?>" class="delete_food_btn"><img title="Delete" style=" padding:10px;" src="http://localhost/php.course/FoodOrder/images/website/delete.png" /></button>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<div class='error'> Food Not Added</div>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <br>
    <nav class="paginator">
        <ul class="pagination">
            <li>
                <a <?php if ($page == 1) {
                        echo "class='disabled'";
                    } ?> href="<?= $_SERVER['PHP_SELF'] . "?page=" . ($page - 1) ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span aria-hidden="true">Previous</span>
                </a>
            </li>
            <li>
                <a <?php if ($page == $page) {
                        echo "class='disabled'";
                    } ?> href=""> Page <?= $page; ?> of <?= $pagesCount; ?></a>
            </li>
            <li>
                <a <?php if ($page == $pagesCount) {
                        echo "class='disabled'";
                    } ?> href="<?= $_SERVER['PHP_SELF'] . "?page=" . ($page + 1) ?>" aria-label="Next">
                    <span aria-hidden="true">Next</span>
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
    <br>
    <script src="../../jsFiles/foodActions.js"> </script>
</div>

<?php
include_once("../partials/footer.php");
?>