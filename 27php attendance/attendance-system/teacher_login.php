<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Teacher Login</h1>
    </header>
    <main>
        <?php if (isset($_GET['error'])) echo "<p class='error'>" . htmlspecialchars($_GET['error']) . "</p>"; ?>
        <form method="POST" action="teacher_login_handlers.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="index.php" class="btn secondary-btn">Back to Home</a>
    </main>
</body>
</html>
