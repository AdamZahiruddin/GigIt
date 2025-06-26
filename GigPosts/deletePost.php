<?php
session_start();
if (!isset($_SESSION['employerID'])) {
    header("Location: ../Login/index.php");
    exit;
}

require("../inc/connect.php");

if (!isset($_GET['postID'])) {
    echo "No post selected.";
    exit;
}

$postID = intval($_GET['postID']);
$employerID = $_SESSION['employerID'];

// Update the post status to 'Deactivated' instead of deleting
$stmt = $connect->prepare("UPDATE post SET status = 'Deactivated' WHERE postID = ? AND employerID = ?");
$stmt->bind_param("is", $postID, $employerID);

if ($stmt->execute()) {
    header("Location: managePosts.php");
    exit;
} else {
    echo "Error deactivating post: " . $connect->error;
}

$stmt->close();
$connect->close();
?>