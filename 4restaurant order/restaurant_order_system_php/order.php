<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $menu_item_id = $_POST['menu_item_id'];
    $quantity = $_POST['quantity'];

    // Insert the order into the orders table
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total) VALUES (?, ?)");
    $stmt->execute([$user_id, 0]); // Total is initially 0

    $order_id = $conn->lastInsertId();

    // Insert the item into order_items table
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, menu_item_id, quantity) VALUES (?, ?, ?)");
    $stmt->execute([$order_id, $menu_item_id, $quantity]);

    // Get the total price for the order
    $stmt = $conn->prepare("SELECT SUM(menu_items.price * order_items.quantity) AS total 
                            FROM order_items
                            JOIN menu_items ON menu_items.id = order_items.menu_item_id
                            WHERE order_items.order_id = ?");
    $stmt->execute([$order_id]);
    $total = $stmt->fetchColumn();

    // Update the total in the orders table
    $stmt = $conn->prepare("UPDATE orders SET total = ? WHERE id = ?");
    $stmt->execute([$total, $order_id]);

    echo "Order placed successfully! Total: $" . number_format($total, 2);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding: 20px;
        }

        .order-container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 30px;
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .order-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        .order-container p {
            font-size: 18px;
            text-align: center;
            margin-bottom: 20px;
        }

        .order-container .total {
            font-size: 20px;
            font-weight: bold;
            color: #28a745;
            text-align: center;
            margin-bottom: 30px;
        }

        .order-container a {
            display: block;
            width: 200px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 auto;
            font-size: 16px;
        }

        .order-container a:hover {
            background-color: #0056b3;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .order-container {
                width: 90%;
                padding: 20px;
            }

            .order-container h2 {
                font-size: 22px;
            }

            .order-container p, .order-container .total {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <div class="order-container">
        <h2>Order Confirmation</h2>
        <p>Your order has been placed successfully!</p>
        <p class="total">Total: $<?= number_format($total, 2); ?></p>
        <a href="menu.php">Go back to the Menu</a>
    </div>

</body>
</html>
