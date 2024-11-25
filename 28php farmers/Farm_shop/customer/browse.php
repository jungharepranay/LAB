<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header('Location: ../auth/login.php');
    exit();
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Products</title>
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
            width: 80%;
            margin: 30px auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .product {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            text-align: center;
        }

        .product:hover {
            transform: translateY(-10px);
        }

        .product h3 {
            font-size: 18px;
            margin: 0;
            color: #333;
        }

        .product p {
            color: #555;
            font-size: 16px;
        }

        .product .price {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            margin: 10px 0;
        }

        .product .add-to-cart {
            background-color: #28a745;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .product .add-to-cart:hover {
            background-color: #218838;
        }

        .no-products {
            text-align: center;
            font-size: 18px;
            color: #666;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="../customer/browse.php">Browse Products</a>
        <a href="../auth/logout.php">Logout</a>
        <a href="../customer/view_cart.php">Cart</a>
    </div>

    <div class="container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <p class="price">₹<?php echo htmlspecialchars($row['price']); ?></p>
                    <!-- Add to Cart Button -->
                    <a href="add_to_cart.php?id=<?php echo $row['id']; ?>&quantity=1" class="add-to-cart">Add to Cart</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-products">No products available.</p>
        <?php endif; ?>
    </div>

</body>
</html>
