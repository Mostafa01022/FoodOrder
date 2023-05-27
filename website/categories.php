<?php
include_once('../partials/menu.php');

require "../classes/website/classCategory.php";

$category = new category();
$data = $category->displayCategoryByActive();

?>
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Categories</h2>

        <?php
        if ($data != "") {
            foreach ($data as $value) {
        ?>
                <a href="category-foods.php?category_id=<?php echo $value['id']; ?>">
                    <div class="box-3 float-container">
                        <?php
                        if ($value['image_name'] == '') {
                            echo "<div class='error'> Image Not Available</div>";
                        } else {
                        ?>
                            <img src="../images/category/<?php echo $value['image_name']; ?>" class="img-responsive img-curve">

                        <?php
                        }

                        ?>
                        <h3 class="float-text text-white"><?php echo $value['title']; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            echo "<div class='error'> Category Not Added</div>";
        }

        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php
include_once('../partials/footer.php');
?>