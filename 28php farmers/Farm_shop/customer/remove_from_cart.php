<?php
session_start();

// Check if the product id is passed via GET request
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Loop through the cart to find and remove the product
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['id'] == $product_id) {
            unset($_SESSION['cart'][$index]);
            break;
        }
    }

    // Reindex the array to prevent gaps in the cart array
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    // Redirect to the view cart page
    header('Location: view_cart.php');
} else {
    echo "Invalid request.";
}
?>
