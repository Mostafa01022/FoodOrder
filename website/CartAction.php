<?php
session_start();

require __DIR__ . "../../vendor/autoload.php";

use Website\Cart;

$cart = new Cart();

if (isset($_POST['add_to_cart'])) {
    $food_arr = array(
        'food_id' => $_POST['food_id'],
        'food_title' => $_POST['food_title'],
        'food_price' => $_POST['food_price'],
        'food_quantity' => $_POST['food_quantity'],
    );
    echo json_encode($cart->addToCart($food_arr));
}

if (isset($_POST['clear'])) {
    unset($_SESSION['cart']);
    $_SESSION['cartCountItems'] = 0;
    echo json_encode(["success" => true]);
}

if (isset($_POST['remove_from_cart'])) {
    echo json_encode($cart->deleteCartItem($_POST['food_id']));
}
