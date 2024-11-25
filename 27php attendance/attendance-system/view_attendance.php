<?php
include 'config.php';
session_start();

// if (!isset($_SESSION['teacher'])) {
//     header("Location: teacher_login.php");
//     exit;
// }

// Fetch students and their attendance records
$stmt = $pdo->query("
    SELECT 
        s.roll_no, s.name, 
        COUNT(a.id) AS total_classes, 
        SUM(a.status = 'Present') AS attended_classes 
    FROM 
        students s 
    LEFT JOIN 
        attendance a 
    ON 
        s.id = a.student_id 
    GROUP BY 
        s.id
");

// Check if there was an error in the query
if ($stmt === false) {
    echo "<p class='error-message'>Error fetching attendance data.</p>";
    exit;
}

$students = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        h2 {
            text-align: center;
            color: #333;
            margin: 20px 0;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            display: block;
            width: fit-content;
            margin: 20px auto;
            text-align: center;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h2>Attendance Records</h2>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>Total Classes</th>
                    <th>Classes Attended</th>
                    <th>Attendance (%)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['roll_no']); ?></td>
                        <td><?php echo htmlspecialchars($student['name']); ?></td>
                        <td><?php echo $student['total_classes'] ?: 0; ?></td>
                        <td><?php echo $student['attended_classes'] ?: 0; ?></td>
                        <td>
                            <?php
                            $total_classes = $student['total_classes'];
                            $attended_classes = $student['attended_classes'];
                            $percentage = $total_classes > 0 ? ($attended_classes / $total_classes) * 100 : 0;
                            echo number_format($percentage, 2) . '%';
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="take_attendance.php">Go Back to Take Attendance</a>
        <a href="index.php">Go to Home Page</a>
    </main>
</body>
</html>
