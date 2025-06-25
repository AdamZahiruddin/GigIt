<?php
// add_notification.php - using mysqli

include '../inc/connect.php'; // Include your mysqli database connection

/**
 * Adds a new notification to the database.
 *
 * @param string $userId 
 * @param string $message 
 * @param string|null $fromUser 
 * @param string $title
 * @return bool 
 */
function addNotification($userId, $message,$title, $fromUser = null) {
    global $connect; 

   
    $stmt = $connect->prepare("INSERT INTO notifications (toUser, notiContent, fromUser, notiTitle) VALUES (?, ?, ?, ?)");

    if ($stmt === false) {
        error_log("Failed to prepare statement: " . $connect->error);
        return false;
    }


    $stmt->bind_param("ssss", $userId, $message, $fromUser , $title);

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