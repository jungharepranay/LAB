<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO teachers (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);

    $success = "Teacher registered successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Teacher</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Register Teacher</h1>
    </header>
    <main>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <a href="index.php" class="btn secondary-btn">Back to Home</a>
    </main>
</body>
</html>
