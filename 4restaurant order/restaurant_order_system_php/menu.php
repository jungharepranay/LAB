<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch menu items
$stmt = $conn->prepare("SELECT * FROM menu_items");
$stmt->execute();
$menu_items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
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

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
        }

        .menu-item {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 15px auto;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .menu-item h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .menu-item p {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .menu-item .price {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 15px;
        }

        .menu-item form {
            display: flex;
            align-items: center;
        }

        .menu-item form label {
            font-size: 16px;
            margin-right: 10px;
        }

        .menu-item form input[type="number"] {
            width: 60px;
            padding: 5px;
            margin-right: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .menu-item form button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .menu-item form button:hover {
            background-color: #0056b3;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .menu-item {
                width: 90%;
                padding: 15px;
            }

            .menu-item h3 {
                font-size: 20px;
            }

            .menu-item p {
                font-size: 14px;
            }

            .menu-item .price {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <h1>Menu</h1>

    <?php foreach ($menu_items as $item): ?>
        <div class="menu-item">
            <h3><?= $item['name']; ?></h3>
            <p><?= $item['description']; ?></p>
            <p class="price">Price: $<?= number_format($item['price'], 2); ?></p>

            <form method="POST" action="order.php">
                <input type="hidden" name="menu_item_id" value="<?= $item['id']; ?>">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" min="1" value="1" required>
                <button type="submit">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>

</body>
</html>
