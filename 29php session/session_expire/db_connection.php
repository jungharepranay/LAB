<?php
$host = 'localhost'; // Your database host (typically localhost)
$username = 'root'; // Your database username
$password = ''; // Your database password
$database = 'session'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
