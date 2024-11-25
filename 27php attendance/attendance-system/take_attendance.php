<?php
session_start();
if (!isset($_SESSION['teacher_id'])) {
    header("Location: teacher_login.php");
    exit;
}

// Include your database connection
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['students'])) {
        $students_present = $_POST['students']; // Array of student IDs marked present

        // Get the current date
        $date = date('Y-m-d');

        // Insert attendance records into the database
        foreach ($students_present as $student_id) {
            $stmt = $pdo->prepare("INSERT INTO attendance (student_id, date, status) VALUES (?, ?, 'Present')");
            $stmt->execute([$student_id, $date]);
        }

        // Optionally, display a success message
        echo "<p class='success-message'>Attendance marked successfully!</p>";
    } else {
        echo "<p class='error-message'>No students selected.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Attendance</title>
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            max-width: 900px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 2em;
            color: #333;
        }

        main {
            margin-top: 20px;
        }

        p {
            font-size: 1.2em;
            color: #555;
        }

        .student-checkbox {
            margin: 10px 0;
        }

        label {
            font-size: 1.1em;
            color: #333;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 1em;
            margin-top: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        button:hover {
            background-color: #45a049;
        }

        a.btn {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        a.btn:hover {
            background-color: #0056b3;
        }

        .success-message {
            color: green;
            font-weight: bold;
        }

        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Take Attendance</h1>
        </header>
        
        <main>
            <p>Welcome, <?= htmlspecialchars($_SESSION['teacher_username']); ?>!</p>

            <!-- Attendance form -->
            <form method="POST" action="">
                <?php
                // Fetch the list of students from the database
                $stmt = $pdo->query("SELECT id, roll_no, name FROM students");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="student-checkbox">';
                    echo '<label>';
                    echo '<input type="checkbox" name="students[]" value="' . $row['id'] . '"> ' . $row['roll_no'] . ' - ' . $row['name'];
                    echo '</label>';
                    echo '</div>';
                }
                ?>
                
                <button type="submit" class="btn primary-btn">Submit Attendance</button>
            </form>

            <a href="index.php" class="btn secondary-btn">Back to Home</a>
        </main>
    </div>
</body>
</html>
