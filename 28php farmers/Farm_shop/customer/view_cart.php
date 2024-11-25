<?php
session_start();

// Check if the cart exists in the session
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your cart is empty.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 900px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .cart-items {
            margin: 20px 0;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        .cart-item h2 {
            font-size: 20px;
            color: #333;
        }

        .cart-item p {
            font-size: 16px;
            color: #777;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }

        .checkout-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            display: block;
            width: 100%;
            margin-top: 20px;
        }

        .checkout-btn:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            color: green;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Your Cart</h1>
    <div class="cart-items">
        <?php
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            echo "<div class='cart-item'>";
            echo "<h2>" . htmlspecialchars($item['name']) . "</h2>";
            echo "<p>Price: ₹" . htmlspecialchars($item['price']) . "</p>";
            echo "<p>Quantity: " . htmlspecialchars($item['quantity']) . "</p>";
            echo "</div>";

            // Calculate total price
            $total += $item['price'] * $item['quantity'];
        }
        ?>
    </div>

    <div class="total">
        Total: ₹<?php echo $total; ?>
    </div>

    <!-- Checkout Button -->
    <button class="checkout-btn" onclick="checkout()">Proceed to Checkout</button>

    <!-- Message after Checkout -->
    <div class="message" id="checkout-message" style="display:none;">
        Checkout Done!
    </div>
</div>

<script>
    // Checkout function that shows the success message
    function checkout() {
        // Hide the checkout button
        document.querySelector('.checkout-btn').style.display = 'none';
        
        // Show the success message
        document.getElementById('checkout-message').style.display = 'block';
        
        // Optionally, add a delay before redirecting (simulating checkout completion)
        setTimeout(function() {
            // Redirect to the order confirmation or success page
            window.location.href = 'order_confirmation.php'; // Modify as needed
        }, 2000); // Delay of 2 seconds before redirect
    }
</script>

</body>
</html>
