<?php
require 'db.php';

// Add a new student
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['roll_number']);
    $email = htmlspecialchars($_POST['email']);

    $stmt = $pdo->prepare("INSERT INTO students (name, roll_number, email) VALUES (?, ?, ?)");

    try {
        $stmt->execute([$name, $age, $email]);
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}

// Delete a student
if (isset($_GET['delete'])) {
    $id = htmlspecialchars($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php");
    exit();
}

// Fetch all students
$stmt = $pdo->query("SELECT * FROM students");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            const name = document.forms["studentForm"]["name"].value;
            const roll_number = document.forms["studentForm"]["roll_number"].value;
            const email = document.forms["studentForm"]["email"].value;

            if (name.trim() === "" || roll_number.trim() === "" || email.trim() === "") {
                alert("All fields are required!");
                return false;
            }

            if (isNaN(age) || roll_number <= 0) {
                alert("roll_number must be a positive number!");
                return false;
            }

            const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!email.match(emailPattern)) {
                alert("Please enter a valid email address!");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Student Management System</h1>

        <form name="studentForm" method="POST" onsubmit="return validateForm()">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="age">roll_number:</label>
            <input type="number" id="roll_number" name="roll_number" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Add Student</button>
        </form>

        <h2>Student List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>roll_number</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['id']); ?></td>
                        <td><?php echo htmlspecialchars($student['name']); ?></td>
                        <td><?php echo htmlspecialchars($student['roll_number']); ?></td>
                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                        <td>
                            <a href="index.php?delete=<?php echo $student['id']; ?>" class="delete-button">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
