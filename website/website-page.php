<?php

require_once('../partials/menu.php');

$displayCategory = new category();
$displayFood = new food();
$dataCat = $displayCategory->displayCategoryByActive_Featured();
$dataFood = $displayFood->displayFoodByActive_Featured();

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>

<?php
if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>
<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php
        if ($dataCat) {
            foreach ($dataCat as $value) {
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

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        if ($dataFood) {
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

    <p class="text-center">
        <a href="foods.php">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->
<?php
require_once('../partials/footer.php');

?>