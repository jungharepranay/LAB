<?php
// Start session to access session variables
session_start();

// Set session timeout duration (5 minutes = 300 seconds)
$timeout_duration = 300; // 5 minutes

// Check if the session's last activity was more than the timeout duration
if (isset($_SESSION['last_activity'])) {
    $inactive_duration = time() - $_SESSION['last_activity'];

    // If the session has expired
    if ($inactive_duration > $timeout_duration) {
        // Destroy the session if expired
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session
        echo "Session expired"; // Respond that the session has expired
        exit();
    }
}

// Update the last activity time with the current time
$_SESSION['last_activity'] = time();
?>
