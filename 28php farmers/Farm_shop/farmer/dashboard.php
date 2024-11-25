<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'farmer') {
    header('Location: ../auth/login.php');
    exit();
}

echo "<h1>Welcome Farmer</h1>";
echo "<a href='add_product.php'>Add Product</a>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #007bff;
            padding: 15px;
            color: white;
            text-align: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 15px;
            border-radius: 5px;
        }

        .navbar a:hover {
            background-color: #0056b3;
        }

        .container {
            width: 70%;
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        a {
            display: inline-block;
            margin: 20px auto;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }

        a:hover {
            background-color: #0056b3;
        }

        h2 {
            color: #333;
        }

        .product-list {
            margin-top: 20px;
        }

        .product-item {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-name {
            font-weight: bold;
        }

        .product-price {
            color: #28a745;
        }

    </style>
</head>
<body>

    <div class="navbar">
        <a href="../farmer/dashboard.php">Dashboard</a>
        <a href="../auth/logout.php">Logout</a>
    </div>

    <div class="container">
        <h1>Welcome Farmer</h1>
        <a href="add_product.php">Add Product</a>

        <h2>Your Products</h2>

        <?php
        $farmer_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM products WHERE farmer_id='$farmer_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="product-list">';
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product-item">';
                echo '<div class="product-name">' . $row['name'] . '</div>';
                echo '<div class="product-price">Price: ' . $row['price'] . ' Rs</div>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo "<p>No products found.</p>";
        }
        ?>
    </div>

</body>
</html>
