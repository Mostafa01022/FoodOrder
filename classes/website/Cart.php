<?php

namespace Website;

use Database;

class Cart extends Database
{

    public function addToCart($itemData)
    {
        if (isset($_SESSION['cart'])) {
            $cartData = $_SESSION['cart'];
            $cartData[$itemData['food_id']] = $itemData;
            $_SESSION['cart'] = $cartData;
            $_SESSION['cartCountItems'] = count($cartData);
        } else {
            $cartData[$itemData['food_id']] = $itemData;
            $_SESSION['cart'] = $cartData;
            $_SESSION['cartCountItems'] = 1;
        }
        return  ['success' => true, "cartCountItems" => $_SESSION['cartCountItems'], 'message' => "Food Added"];
    }

    public function deleteCartItem($id)
    {
        $cartData = $_SESSION['cart'];
        unset($cartData[$id]);
        $_SESSION['cart'] = $cartData;
        $_SESSION['cartCountItems'] = count($cartData);
        return ['success' => true, "cartCountItems" => $_SESSION['cartCountItems'], 'message' => "Food Deleted Successfully"];
    }
}
