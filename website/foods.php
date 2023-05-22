<?php
include_once('../partials/menu.php');

$display = new food();
$dataFood = $display->displayAllFoods();
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



    <div class="clearfix"></div>

    </div>

</section>
<!-- fOOD Menu Section Ends Here -->


<?php
include_once('../partials/footer.php');
?>