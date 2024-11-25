<?php
session_start();
include '../db.php';

// Check if product id and quantity are passed via GET request
if (isset($_GET['id']) && isset($_GET['quantity'])) {
    $product_id = $_GET['id'];
    $quantity = $_GET['quantity'];

    // Fetch product details from the database
    $sql = "SELECT * FROM products WHERE id = '$product_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        
        // Check if the cart already exists in the session, if not, create it
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Check if the product already exists in the cart, update quantity if it does
        $found = false;
        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['id'] == $product['id']) {
                $_SESSION['cart'][$index]['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        // If product is not already in the cart, add it
        if (!$found) {
            $_SESSION['cart'][] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity
            ];
        }

        // Redirect to the cart page
        header('Location: view_cart.php');
        exit();
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid request.";
}
?>
