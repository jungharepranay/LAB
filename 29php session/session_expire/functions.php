<?php
function limitConcurrentSessions($user_id, $session_id) {
    global $conn;

    $max_sessions = 3;

    // Delete sessions older than 5 minutes
    $delete_query = "DELETE FROM user_sessions WHERE user_id = '$user_id' AND last_activity < NOW() - INTERVAL 5 MINUTE";
    if (!$conn->query($delete_query)) {
        die('Error deleting sessions: ' . $conn->error);
    }

    // Count current active sessions
    $count_query = "SELECT COUNT(*) AS session_count FROM user_sessions WHERE user_id = '$user_id'";
    $result = $conn->query($count_query);
    if (!$result) {
        die('Error counting sessions: ' . $conn->error);
    }
    $row = $result->fetch_assoc();

    // If there are more than the max allowed sessions, deny new session creation
    if ($row['session_count'] >= $max_sessions) {
        echo "You have reached the maximum number of concurrent sessions.";
        exit();
    }

    // Check if this unique session ID already exists for the user
    $check_session_query = "SELECT * FROM user_sessions WHERE session_id = '$session_id'";
    $check_session = $conn->query($check_session_query);
    if (!$check_session) {
        die('Error checking session: ' . $conn->error);
    }

    if ($check_session->num_rows > 0) {
        // Update the session's last_activity if it already exists
        $update_query = "UPDATE user_sessions SET last_activity = NOW() WHERE session_id = '$session_id'";
        if (!$conn->query($update_query)) {
            die('Error updating session: ' . $conn->error);
        }
    } else {
        // Insert new session record if not already present
        $insert_query = "INSERT INTO user_sessions (session_id, user_id) VALUES ('$session_id', '$user_id')";
        if (!$conn->query($insert_query)) {
            die('Error inserting session: ' . $conn->error);
        }
    }
}

?>
