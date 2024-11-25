<?php
session_start();
require_once 'db.php'; // Make sure this is your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Prepare the SQL statement to fetch all orders for the logged-in user
$stmt = $conn->prepare("SELECT id, total FROM orders WHERE user_id = ? ORDER BY id DESC");
$stmt->execute([$user_id]);

// Fetch all the orders
$orders = $stmt->fetchAll();

// Check if the user has any orders
if (empty($orders)) {
    echo "<p>You haven't placed any orders yet.</p>";
} else {
    echo "<h1>Your Orders</h1>";
    echo "<table border='1' cellpadding='10' cellspacing='0'>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>";

    // Loop through each order and display it
    foreach ($orders as $order) {
        echo "<tr>
                <td>{$order['id']}</td>
                <td>$" . number_format($order['total'], 2) . "</td>
              </tr>";
    }

    echo "</tbody></table>";
}
?>
