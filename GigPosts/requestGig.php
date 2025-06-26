<?php
session_start();
include("../nav.php");
require("../inc/connect.php");

$postID = isset($_GET['postID']) ? intval($_GET['postID']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['employeeID'])) {
    $employeeID = $_SESSION['employeeID'];
    $requestDetails = trim($_POST['requestDetails'] ?? '');

    if ($postID && $requestDetails) {
        $requestStatus = "Pending";
        $stmt = $connect->prepare("INSERT INTO application (requestStatus, employeeID, postID, requestDetails) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $requestStatus, $employeeID, $postID, $requestDetails);
        if ($stmt->execute()) {
            // Add notification for employer
            notifyEmployerOnGigRequest($connect, $postID, $employeeID);
            echo "<script>alert('Request submitted!');window.location='../homePage.php';</script>";
            exit;
        } else {
            echo "<script>alert('Failed to submit request.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Please enter a message.');</script>";
    }
}

/**
 * Notify employer when a gig is requested
 */

 
function notifyEmployerOnGigRequest($connect, $postID, $employeeID) {
    // Get employerID and post title
    $employerID = null;
    $postTitle = null;
    $stmt = $connect->prepare("SELECT employerID, title FROM post WHERE postID = ?");
    $stmt->bind_param("i", $postID);
    $stmt->execute();
    $stmt->bind_result($employerID, $postTitle);
    if ($stmt->fetch()) {
        $stmt->close();
        // Prepare notification message
        $message = "You have a new application for your gig: \"$postTitle\".";
        // Call your notification function (adjust path if needed)
        include_once("../addnotification.php");
        addNotification($employerID, $message, "New Gig Application", $employeeID);
    } else {
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Request Gig - GigIt</title>
  <link rel="stylesheet" href="../styling/stylegig.css">
  <link rel="stylesheet" href="../styling/stylePost.css">
</head>
<body class="lightmode">
   <?php include("../topbar.php");?>
    
  <div class="mid-section">
    <h2 class="create-title">Gig Request</h2>
      <div class="create-container">
        <div class="form-content">
            <span class="req-title">Message:</span>
          <form action="requestGig.php?postID=<?= $postID ?>" method="post">
            <div class="form-row">
              <textarea class="text-box" id="gig-req" name="requestDetails" placeholder="Write an application message to the employer" required></textarea>
            </div>
            <div class="form-actions">
              <button class="btn-create" id="btn-req" type="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</body>
</html>