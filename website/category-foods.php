<?php
include_once('../partials/menu.php');
?>
<?php
if (isset($_GET['category_id'])) {
    $id = $_GET['category_id'];
    $displayCategory = new category();
    $displayFood = new food();
    $dataFood = $displayFood->displayCategor_Foods($id);
    $dataCat = $displayCategory->displayCategoryById($id);
} else {
    header("location:website-page.php");
}
?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="#" class="text-white">"<?php echo $dataCat['title'] ?>"</a></h2>
    </div>
</section>
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        if ($dataFood != "") {
            foreach ($dataFood as $value) {
        ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($value['image_name'] == '') {
                            echo "<div class='error'> Image Not Available</div>";
                        } else {
                        ?>
                            <img src="../images/food/<?php echo $value['image_name']; ?>" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $value['title']; ?></h4>
                        <p class="food-price"><?php echo '$ ' . $value['price']; ?></p>
                        <p class="food-detail">
                            <?php echo $value['description']; ?>
                        </p>
                        <br>

                        <a href="order.php?id=<?php echo $value['id'] ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

    <?php
                        }
                    }
                } else {
                    echo "<div class='error'> Food Not Added</div>";
                }
    ?>


    </div>

    <div class="clearfix"></div>

    </div>


</section>
<!-- fOOD Menu Section Ends Here -->
<?php
include_once('../partials/footer.php');
?>