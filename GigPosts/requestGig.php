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
            echo "<script>alert('Request submitted!');window.location='/GigIt/homePage.php';</script>";
            exit;
        } else {
            echo "<script>alert('Failed to submit request.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Please enter a message.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Request Gig - GigIt</title>
  <link rel="stylesheet" href="../stylegig.css">
  <link rel="stylesheet" href="../stylePost.css">
</head>
<body class="lightmode">
  <div class="top-bar">
    <div class="search-notify-container">
      <form class="search-bar" action="searchedPost.php" method="get">
        <input type="text" id="searchinput" name="name" placeholder="Search..." value="<?= htmlspecialchars($_GET['name'] ?? '') ?>" required>
        <button id="searchsubmit" type="submit">
          <img src="https://cdn-icons-png.flaticon.com/512/622/622669.png" alt="Search" width="20" height="20">
        </button>
      </form>
      <button class="notification-btn">
        <img src="https://cdn-icons-png.flaticon.com/512/1827/1827392.png" alt="Notifications" width="24" height="24">
        <span class="notification-badge">0</span>
      </button>
    </div>
  </div>
    
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