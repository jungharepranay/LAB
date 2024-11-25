<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        .converter {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 300px;
            width: 100%;
        }
        .converter h1 {
            margin-bottom: 20px;
            font-size: 20px;
            color: #333;
        }
        .converter input[type="number"] {
            width: 80%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .converter button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }
        .converter button:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 15px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="converter">
        <h1>Dollar to Rupee Converter</h1>
        <form method="POST">
            <input type="number" name="amount" placeholder="Enter amount in USD" required step="0.01">
            <button type="submit">Convert</button>
        </form>
        <?php
        // Hard-coded exchange rate
        $exchangeRate = 82.50; // 1 USD = 82.50 INR (example rate)

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $amountInUSD = floatval($_POST['amount']); // Get the input amount
            if ($amountInUSD > 0) {
                $convertedAmount = $amountInUSD * $exchangeRate; // Conversion logic
                echo "<div class='result'>{$amountInUSD} USD = " . number_format($convertedAmount, 2) . " INR</div>";
            } else {
                echo "<div class='result'>Please enter a valid amount.</div>";
            }
        }
        ?>
    </div>
</body>
</html>
