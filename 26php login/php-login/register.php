<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $error = "Email is already registered.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        $success = "Registration successful! <a href='login.php'>Login here</a>.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - User Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar">
            <div class="container">
                <h1 class="navbar-brand">User System</h1>
                <div class="nav-links">
                    <a href="index.php">Home</a>
                    <a href="login.php">Login</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Register Form -->
    <div class="form-container">
        <h2>Register</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error; ?></p>
        <?php elseif (isset($success)): ?>
            <p class="success"><?= $success; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn primary-btn">Register</button>
        </form>
        <p class="text-muted">Already have an account? <a href="login.php">Login here</a>.</p>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 User Management System. All rights reserved.</p>
    </footer>
</body>
</html>
