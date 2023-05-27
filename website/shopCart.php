<?php
require_once('../partials/menu.php');

?>
<div class="container">
    <form id="cartForm" method="post">
        <table class="tbl-full readInput" id="cart_table">
            <thead>
                <tr>
                    <th>Food Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                if (!empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $key => $value) {
                ?>
                        <tr id="row_<?= $value['food_id']; ?>">
                            <td><input id="food_name" class="food_name" name="food_name" type="text" value='<?= $value['food_title']; ?>' readonly></td>
                            <td><input type="number" min="1" name="food_quantity" food_id="<?= $value['food_id'] ?>" class="food_quantity" type="text" value='<?= $value['food_quantity']; ?>'></td>
                            <td><input name="food_price" class="food_price" type="text" value='<?= $value['food_price']; ?>' readonly></td>
                            <td>
                                <input type="text" class="food_total_price" name="qnt_price" value='<?= number_format($value['food_price'] * $value['food_quantity'], decimals: 2); ?>' readonly>
                            </td>
                            <td> <button type="button" food_id="<?= $value['food_id'] ?>" class="btn btn-primary remove_btn">remove</button></td>
                        </tr>
                <?php
                        $total = $total + ($value['food_price'] * $value['food_quantity']);
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan=" 3">total</td>
                    <td><span id="total_price"><?= $total ?></span></td>
                    <td><button type="submit" id="order_btn" class="btn btn-sm btn-2">Order </button>
                        <button type="button" id="clear_btn" class="btn btn-sm btn-primary">Clear All</button>
                    </td>
                    </td>
                </tr>
            </tfoot>
            <?php
            ?>
        </table>
    </form>
    <section class=" popup ">
        <div class="container">
            <p class="text-center text-white">Fill this form to confirm your order.</p>
            <form action="" method="post" id="orderForm">
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Mostafa Ramadan" class="input-responsive" required>
                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>
                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@mostafa.com" class="input-responsive" required>
                    <div class="order-label">Address</div>
                    <textarea name="address" rows="5" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                    <input type="hidden" name="confirm_order" value="Confirm Order" class="btn btn-primary">
                    <input type="submit" value="Confirm Order" class="btn btn-primary">
                    <input type="button" id="cancel_order" value="Cancel Order" class="btn btn-primary">
                </fieldset>
            </form>
        </div>
    </section>
    <script src="../jsFiles/shopCart.js"></script>
</div>