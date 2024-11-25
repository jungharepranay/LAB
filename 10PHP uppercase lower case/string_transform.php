<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP String Transformations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        form {
            max-width: 500px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: inline-block;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 10px 15px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        p {
            font-size: 16px;
            color: #555;
            text-align: center;
        }

        strong {
            color: #000;
        }
    </style>
</head>
<body>
    <h1>PHP String Transformations</h1>
    <form method="POST" action="">
        <label for="inputString">Enter a String:</label><br>
        <input type="text" id="inputString" name="inputString" required>
        <br><br>
        <button type="submit" name="transform" value="uppercase">Transform to UPPERCASE</button>
        <button type="submit" name="transform" value="lowercase">Transform to lowercase</button>
        <button type="submit" name="transform" value="ucfirst">Capitalize First Character</button>
        <button type="submit" name="transform" value="ucwords">Capitalize First Letter of Each Word</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inputString']) && isset($_POST['transform'])) {
        $inputString = $_POST['inputString'];
        $transform = $_POST['transform'];
        $result = '';

        // Perform the transformation based on the button clicked
        switch ($transform) {
            case 'uppercase':
                $result = strtoupper($inputString);
                break;

            case 'lowercase':
                $result = strtolower($inputString);
                break;

            case 'ucfirst':
                $result = ucfirst($inputString);
                break;

            case 'ucwords':
                $result = ucwords($inputString);
                break;

            default:
                $result = 'Invalid transformation type.';
        }

        // Display the result
        echo "<h2>Transformed String:</h2>";
        echo "<p><strong>Original String:</strong> $inputString</p>";
        echo "<p><strong>Transformed String:</strong> $result</p>";
    }
    ?>
</body>
</html>
