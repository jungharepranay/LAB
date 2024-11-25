<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roll_no = $_POST['roll_no'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO students (roll_no, name, email) VALUES (?, ?, ?)");
    $stmt->execute([$roll_no, $name, $email]);

    $success = "Student registered successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Register Student</h1>
    </header>
    <main>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <form method="POST" action="">
            <input type="text" name="roll_no" placeholder="Roll No" required>
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Register</button>
        </form>
        <a href="index.php" class="btn secondary-btn">Back to Home</a>
    </main>
</body>
</html>
