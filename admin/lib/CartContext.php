<?php


global $db;

$product_name = $image = $price = $quantity = "";

// check if the cart array exists in the session, if not create it
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// check if the product has been added to cart
if (isset($_POST['add_to_cart'])) {
    // get product details
    $product_id = $_POST['product_id'];
    $product = $db->read("products", "*", "product_id = '$product_id'");
    if ($product) {
        $product_name = $product['product_name'];
        $image = $product['image'];
        $price = $product['price'];
        $quantity = 1;
    }

    // Check if the item already exists in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = [
            'product_id' => $product_id,
            'image' => $image,
            'product_name' => $product_name,
            'price' => $price,
            'quantity' => $quantity
        ];
    }

}

// check if the product has been added to cart
if (isset($_POST['add'])) {
    // get product details
    $product_id = $_POST['product_id'];
    // Check if the item already exists in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    }
}

if (isset($_POST['minus'])) {
    // get product details
    $product_id = $_POST['product_id'];
    // Check if the item already exists in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] -= 1;
    }
}

if (isset($_POST['remove'])) {
    $product_id = $_POST['product_id'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

if (isset($_POST['remove_all'])) {
    if (isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
}

?>