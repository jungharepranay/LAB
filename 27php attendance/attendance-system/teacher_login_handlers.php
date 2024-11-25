<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to validate teacher
    $stmt = $pdo->prepare("SELECT * FROM teachers WHERE username = ?");
    $stmt->execute([$username]);
    $teacher = $stmt->fetch();

    if ($teacher && password_verify($password, $teacher['password'])) {
        // Save session variables and redirect
        $_SESSION['teacher_id'] = $teacher['id'];
        $_SESSION['teacher_username'] = $teacher['username'];
        header("Location: take_attendance.php"); // Ensure this file exists
        exit;
    } else {
        header("Location: teacher_login.php?error=" . urlencode("Invalid username or password."));
        exit;
    }
}
?>
