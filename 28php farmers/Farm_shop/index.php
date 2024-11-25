<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shopping System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        nav {
            margin: 10px 0;
            text-align: center;
        }
        nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #333;
            font-size: 18px;
        }
        nav a:hover {
            color: #007bff;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Online Shopping System</h1>
    </header>

    <nav>
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Links for logged-in users -->
            <?php if ($_SESSION['role'] == 'farmer'): ?>
                <a href="farmer/dashboard.php">Farmer Dashboard</a>
            <?php else: ?>
                <a href="customer/browse.php">Browse Products</a>
                <a href="customer/cart.php">My Cart</a>
            <?php endif; ?>
            <a href="auth/logout.php">Logout</a>
        <?php else: ?>
            <!-- Links for guests -->
            <a href="auth/login.php">Login</a>
            <a href="auth/register.php">Register</a>
        <?php endif; ?>
    </nav>

    <div class="container">
        <h2>About Us</h2>
        <p>
            This platform connects farmers with customers, allowing farmers to list their agricultural products online and customers to purchase fresh, locally-grown produce. 
            We aim to support farmers and bring fresh, quality products directly to your doorstep.
        </p>
        <h2>Features</h2>
        <ul>
            <li>Farmers can register and list their products for sale.</li>
            <li>Customers can browse and purchase products.</li>
            <li>Simple and easy-to-use interface for all users.</li>
        </ul>
    </div>

    <footer>
        <p>&copy; 2024 Online Shopping System. All rights reserved.</p>
    </footer>
</body>
</html>


<!--
create folder in vs "farm_shop"
Go to C:\xampp\htdocs and paste the folder in it.
and open it in vs.
  Open xampp control panel
  start apache n mysql
  click on admin
  click add to create database and name it as online_shop
  -----------------------------------------------------------
  then click on SQL and add the structure of table :

CREATE DATABASE IF NOT EXISTS online_shop;

USE online_shop;

-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('farmer', 'customer') NOT NULL
);

-- Products table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    farmer_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (farmer_id) REFERENCES users(id)
);

-- Orders table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES users(id)
);

-- Cart table
CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
---------------------------------------------------------------

click go.

---------------------------------------------------------------

go to browser and run it by:
http://localhost:8080/farm_shop/index.php

        -->
