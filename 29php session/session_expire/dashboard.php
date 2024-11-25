<?php
session_start();
require 'check_session_timeout.php'; // Include the session timeout check
require 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID

// Fetch user information from the database
$result = $conn->query("SELECT * FROM users WHERE id = '$user_id'");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Container for the content */
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Welcome message styling */
        .welcome-message {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Button for logging out */
        .logout-btn {
            display: block;
            width: 200px;
            padding: 10px;
            margin: 20px auto;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #0056b3;
        }

        /* Error message styling */
        .error {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="welcome-message">
            <?php echo "Welcome, " . htmlspecialchars($user['username']); ?>
        </div>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- JavaScript to periodically check if the session has expired -->
    <script>
        // Function to check if session has expired
        function checkSession() {
            fetch('check_session_timeout.php')
                .then(response => response.text())
                .then(data => {
                    if (data === "Session expired") {
                        // If session has expired, redirect to login page
                        window.location.href = "login.php";
                    }
                })
                .catch(error => console.error("Error checking session:", error));
        }

        // Periodically check every 30 seconds
        setInterval(checkSession, 30000); // Check every 30 seconds
    </script>

</body>
</html>
