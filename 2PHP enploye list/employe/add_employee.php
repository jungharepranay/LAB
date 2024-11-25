<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
</head>
<body>
    <h1>Add Employee</h1>
    <form action="add_employee.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>
        
        <label for="position">Position:</label>
        <input type="text" name="position" id="position" required><br>
        
        <label for="department">Department:</label>
        <input type="text" name="department" id="department" required><br>
        
        <label for="salary">Salary:</label>
        <input type="number" name="salary" id="salary" required><br>
        
        <label for="hire_date">Hire Date:</label>
        <input type="date" name="hire_date" id="hire_date" required><br>
        
        <button type="submit" name="submit">Add Employee</button>
    </form>
    <a href="index.php">View Employee List</a>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];
    $hire_date = $_POST['hire_date'];

    $sql = "INSERT INTO employees (name, position, department, salary, hire_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $position, $department, $salary, $hire_date]);

    echo "<p>Employee added successfully!</p>";
}
?>
