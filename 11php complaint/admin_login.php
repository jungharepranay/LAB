<?php
session_start(); // Ensure session handling is started

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Trim and sanitize input to avoid unnecessary spaces or security risks
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Fixed admin credentials
    $adminUsername = 'admin';
    $adminPassword = 'vit123';

    // Verify credentials
    if ($username === $adminUsername && $password === $adminPassword) {
        $_SESSION['admin_id'] = true; // Set admin session variable
        header("Location: admin_dashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        $error = "Invalid admin credentials!"; // Error message for incorrect login
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css"> <!-- Ensure style.css exists in the same directory -->
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>

        <!-- Display error message, if any -->
        <?php if (isset($error)) : ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <!-- Login form -->
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
