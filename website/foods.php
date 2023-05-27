<?php
include_once('../partials/menu.php');
require "../classes/website/classFood.php";

$display = new food();
$dataFood = $display->displayAllFoods();
?>

<div id="action_message"></div>

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
                <form class="addToCartForm" method="post">
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            if ($value['image_name'] == '') {
                                echo "<div class='error'> Image Not Available</div>";
                            } else {
                            ?>
                                <img src="../images/food/<?php echo $value['image_name']; ?>" class="img-responsive img-curve">
                        </div>

                        <div class="food-menu-desc no-border">
                            <h4><?php echo $value['title']; ?></h4>
                            <input type="number" name="food_quantity" min="1" value="1">
                            <input type="text" class="food-price" value="<?= '$ ' . $value['price']; ?>">
                            <p class="food-detail">
                                <?php echo $value['description']; ?>
                            </p>
                            <br>
                            <input type="hidden" name="food_id" value="<?= $value['id'] ?>">
                            <input type="hidden" name="food_title" value="<?= $value['title'] ?>">
                            <input type="hidden" name="food_price" value="<?= $value['price'] ?>">
                            <input type="hidden" name="add_to_cart">
                            <button type="submit" class="btn btn-primary">Add To cart</button>
                        </div>
                    </div>
                </form>
    <?php
                            }
                        }
                    } else {
                        echo "<div class='error'> Food Not Added</div>";
                    }
    ?>
    <div class="clearfix"></div>
    </div>
    <script src="../jsFiles/addToCart.js"></script>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php
include_once('../partials/footer.php');
?>