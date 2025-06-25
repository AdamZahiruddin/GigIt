<?php
session_start();
require("../inc/connect.php");
include("../nav.php");

if (!isset($_SESSION['employeeID'])) {
    echo "You must be logged in as an employee to view your current gig.";
    exit;
}

$employeeID = $_SESSION['employeeID'];

// Get the most recent accepted gig for this employee
$sql = "SELECT p.*, a.requestID, a.requestStatus
        FROM application a
        JOIN post p ON a.postID = p.postID
        WHERE a.employeeID = ? AND a.requestStatus = 'Accepted'
        ORDER BY a.requestID DESC LIMIT 1";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $employeeID);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Current Gig - GigIt</title>
  <link rel="stylesheet" href="../stylegig.css">
  <link rel="stylesheet" href="../stylePost.css">
</head>
<body class="lightmode">
  <div class="mid-section">
    <h2 class="create-title">My Current Accepted Gig</h2>
    <?php if ($post): ?>
      <div class="post-container">
        <div class="post-content">
          <h2><?= htmlspecialchars($post['title']) ?></h2>
          <h3><?= htmlspecialchars($post['description']) ?></h3>
          <div class="details-container">
            <div class="details-row"><span class="details-label">Contact:</span><span class="details-value"><?= htmlspecialchars($post['contact']) ?></span></div>
            <div class="details-row"><span class="details-label">Location:</span><span class="details-value"><?= htmlspecialchars($post['location']) ?></span></div>
            <div class="details-row"><span class="details-label">Wage:</span><span class="details-value"><?= htmlspecialchars($post['wages']) ?></span></div>
            <div class="details-row"><span class="details-label">Date:</span><span class="details-value"><?= htmlspecialchars($post['date']) ?></span></div>
            <div class="details-row"><span class="details-label">Status:</span><span class="details-value"><?= htmlspecialchars($post['status']) ?></span></div>
          </div>
        </div>
      </div>
    <?php else: ?>
      <p>You have no accepted gigs at the moment.</p>
    <?php endif; ?>
  </div>
</body>
</html>
