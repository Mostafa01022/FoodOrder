<?php
include_once('../partials/menu.php');

$food_id = $_GET['id'];

if (isset($food_id)) {
    $display = new food();
    $insert = new order();
    $dataFood = $display->displayFoodById($food_id);
} else {
    header('location:website-page.php');
}

if (isset($_POST['submit'])) {
    $insert = $insert->insert_order($_POST);
}

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="post" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    if ($dataFood['image_name'] != "") {
                    ?>
                        <img src="../images/food/<?php echo $dataFood['image_name']; ?>" class="img-responsive img-curve">
                    <?php
                    } else {
                        echo "<div class='error'>Image Not Available .</div>";
                    }
                    ?>

                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $dataFood['title']; ?></h3>
                    <input type="hidden" name="title" value="<?php echo $dataFood['title']; ?>">

                    <p class="food-price">$ <?php echo $dataFood['price']; ?></p>
                    <input type="hidden" name="price" value="<?php echo $dataFood['price']; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="quantity" min="1" class="input-responsive" value="1" max="20" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Mostafa Ramadan" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@mostafa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php
include_once('../partials/footer.php');
