<?php
// add_notification.php - using mysqli

include 'connect.php'; // Include your mysqli database connection

/**
 * Adds a new notification to the database.
 *
 * @param int $userId The ID of the user to receive the notification.
 * @param string $message The notification message.
 * @param string|null $link Optional link associated with the notification.
 * @return bool True on success, false on failure.
 */
function addNotification($userId, $message, $link = null) {
    global $conn; // Use the mysqli connection object from db_connect.php

    // Prepare the SQL statement for security against SQL injection
    $stmt = $conn->prepare("INSERT INTO notifications (toUser, message, link) VALUES (?, ?, ?)");

    if ($stmt === false) {
        error_log("Failed to prepare statement: " . $conn->error);
        return false;
    }

    // Bind parameters
    // 'sis' stands for:
    // s - string (message)
    // i - integer (user_id)
    // s - string (link) - even if null, it's treated as a string type
    $stmt->bind_param("iss", $userId, $message, $link);

    // Execute the statement
    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        error_log("Error executing statement: " . $stmt->error);
        $stmt->close();
        return false;
    }
}

// Example usage (you would call this from your application logic)
// To add a notification for user 1:
// if (addNotification(1, 'You have a new message!', '/messages')) {
//     echo "Notification added successfully.";
// } else {
//     echo "Failed to add notification.";
// }

// Or, for testing via a POST request (e.g., from Postman or a form):
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['message'])) {
//     $userId = (int)$_POST['user_id'];
//     $message = $_POST['message'];
//     $link = $_POST['link'] ?? null; // Null if 'link' is not provided

//     if (addNotification($userId, $message, $link)) {
//         echo "Notification added for user $userId: $message";
//     } else {
//         echo "Error adding notification.";
//     }
// }
?>