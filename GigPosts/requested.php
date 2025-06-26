<?php
session_start();
require("../inc/connect.php");
include("../nav.php");

if (!isset($_SESSION['employeeID'])) {
    echo "You must be logged in as an employee to view your requests.";
    exit;
}

$employeeID = $_SESSION['employeeID'];

// Fetch all pending requests for this employee
$sql = "SELECT a.*, p.title, p.description, p.location, p.wages, p.date, p.contact
        FROM application a
        JOIN post p ON a.postID = p.postID
        WHERE a.employeeID = ? AND a.requestStatus = 'Pending'
        ORDER BY a.requestID DESC";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $employeeID);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Pending Requests - GigIt</title>
  <link rel="stylesheet" href="../styling/stylegig.css">
  <link rel="stylesheet" href="../styling/stylePost.css">
</head>
<body class="lightmode">
  <div class="mid-section">
    <h2 class="create-title">My Pending Requests</h2>
    <?php if ($result->num_rows > 0): ?>
      <div class="applicant-list">
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="applicant-card">
            <strong><?= htmlspecialchars($row['title']) ?></strong>
            <br>
            <em><?= htmlspecialchars($row['description']) ?></em>
            <br>
            <span>Contact: <?= htmlspecialchars($row['contact'])?></span><br> 
            <span>Location: <?= htmlspecialchars($row['location']) ?></span><br>
            <span>Wage: <?= htmlspecialchars($row['wages']) ?></span><br>
            <span>Date: <?= htmlspecialchars($row['date']) ?></span><br>
            <span>Status: <b><?= htmlspecialchars($row['requestStatus']) ?></b></span>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p>You have no pending requests.</p>
    <?php endif; ?>
  </div>
</body>
</html>