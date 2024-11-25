<?php
session_start();
include 'config.php';

// Check if the teacher is logged in
if (!isset($_SESSION['teacher_id'])) {
    header("Location: teacher_login.php");
    exit;
}

// Process attendance data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['attendance']) && is_array($_POST['attendance'])) {
        $attendance = $_POST['attendance']; // Array of student IDs
        $teacher_id = $_SESSION['teacher_id'];

        foreach ($attendance as $student_id) {
            $stmt = $pdo->prepare("INSERT INTO attendance (student_id, teacher_id, date) VALUES (?, ?, NOW())");
            $stmt->execute([$student_id, $teacher_id]);
        }

        $success_message = "Attendance successfully submitted!";
    } else {
        $error_message = "No students selected for attendance.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Submission</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Attendance Submission</h1>
    </header>
    <main>
        <?php if (isset($success_message)): ?>
            <p class="success"><?= htmlspecialchars($success_message); ?></p>
        <?php elseif (isset($error_message)): ?>
            <p class="error"><?= htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        
        <!-- Provide options to view attendance or go to home -->
        <div class="actions">
            <a href="view_attendance.php" class="btn primary-btn">View Attendance</a>
            <a href="index.php" class="btn secondary-btn">Go to Home</a>
        </div>
    </main>
</body>
</html>
