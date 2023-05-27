<?php
include_once("../partials/menu.php");
include __DIR__ . "../../../classes/management/classManageCategory.php";

$obj = new manangeCategory();
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if (isset($_GET['page']) && $_GET['page'] <= 0) {
    header('location:http://localhost/php.course/food-order/admin/categoryControl/manage-category.php');
}
$catCount = $obj->categoryCount();
$limit = 3;
$pagesCount = ceil($catCount / $limit);
$data = $obj->displayCategory($limit, $page);
?>

<div class="main-content">
    <div class="wrapper">
        <h1> Manage Category</h1>
        </br>
        <div>
            <button id="add_btn" class="btn-primary">Add Category</button>
            <input type="search" placeholder="search ..." class="search">
        </div>
        <div id="action_message"></div>
        </br>
        <div style="width: 30%;" class="popup" id="addCatPopup">
            <form id="addCatForm" method="post" enctype="multipart/form-data">
                <h1>Add Category</h1>
                <table style="width: 100%;    margin:5px; font-weight:bold;">
                    <tr>
                        <td>Title :</td>
                        <td><input type="text" id="title" name="title" placeholder="Enter Title" required style="padding: 0; margin:0;"></td>
                    </tr>
                    <tr>
                        <td>Image :</td>
                        <td>
                            <input type="file" id="image" name="image" required style="padding: 0; margin:0;">
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
                <input type="hidden" value="addCat" name="action" class="add-btn">
                <button type="submit" id="addCat_submit" name="add_cat" class="add-btn">Add</button>
                <button type="button" name="close" id="closeAddForm" class="close-btn">Close</button>
            </form>
        </div>
        <div style="width: 30%;" class="popup" id="updateCatPopup">
            <form id="updateCatForm" method="post" enctype="multipart/form-data">
                <h1>Update Category</h1>
                <table style="width: 100%;    margin:5px; font-weight:bold;">
                    <tr>
                        <td>Title :</td>
                        <td><input type="text" id="update_title" name="update_title" placeholder="Enter Title" required style="padding: 0; margin:0;"></td>
                    </tr>
                    <tr>
                        <td>New Image :</td>
                        <td>
                            <input type="file" id="image_new" name="new_image" required style="padding: 0; margin:0;">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured :</td>
                        <td>
                            Yes<input type="radio" name="update_featured" id="updatE_featured" value="yes" required style="padding: 0; margin:0;">
                            No <input type="radio" name="update_featured" id="updatE_featured" value="no" required style="padding: 0; margin:0;">
                        </td>
                    </tr>
                    <tr>
                        <td>Active :</td>
                        <td>
                            Yes <input type="radio" id="update_active" name="update_active" value="yes" required style="padding: 0; margin:0;">
                            No <input type="radio" id="update_active" name="update_active" value="no" required style="padding: 0; margin:0;">
                        </td>
                    </tr>
                </table>
                <input type="hidden" id="update_id" name="update_id" class="add-btn">
                <input type="hidden" id="old_image" name="old_image" class="add-btn">
                <button type="submit" name="updateCat_submit" id="updateCat_submit" value="<?= $value['id']; ?>" class="add-btn">Update</button>
                <button type="button" name="close" id="closeUpdateForm" class="close-btn">Close</button>
            </form>
        </div>
        <table class="tbl-full">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
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
                        <tr id="category_row_<?= $value['id'] ?>">
                            <td><?php echo $sn++; ?></td>
                            <td class="category_title"><?php echo $value['title']; ?></td>
                            <td class="category_img">
                                <?php
                                if ($value['image_name'] != "") {
                                ?>
                                    <img src='../../images/category/<?php echo $value['image_name']; ?>' width="100px">
                                <?php
                                } else {
                                    echo "<div color='red'>Image Not Found</div>";
                                }
                                ?>
                            </td>
                            <td class="category_featured"><?php echo $value['featured']; ?></td>
                            <td class="category_active"><?php echo $value['active']; ?></td>
                            <td style="width: 15%; padding:25px;">
                                <button value=<?= $value['id']; ?> class="update_btn_class">
                                    <img title="Update" src="http://localhost/php.course/food-order/images/website/update.png" /></button>
                                <button value="<?= $value['id']; ?>" data-image_name="<?php echo $value['image_name']; ?>" class="delete_category_btn">
                                    <img title="Delete" src="http://localhost/php.course/food-order/images/website/delete.png" />
                                </button>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<div class='error'> Category Not Added</div>";
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
</div>
<script src="../../jsFiles/categoryActions.js?v=<?= filemtime("../../jsFiles/categoryActions.js") ?>"></script>


<?php
include_once("../partials/footer.php");
?>