<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include("../nav.php");
require("../inc/connect.php");

if (!isset($_SESSION['employerID'])) {
  echo "You must be logged in as an employer to view this page.";
  exit;
}

$employerID = trim($_SESSION['employerID']);

// --- MOVE POST HANDLING TO BEFORE SELECT ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['requestID'])) {
  $action = $_POST['action'];
  $requestID = intval($_POST['requestID']);
  if ($action === 'accept') {
    $newStatus = 'Accepted';

    // Get employeeID and postID for this application
    $getAppStmt = $connect->prepare("SELECT employeeID, postID FROM application WHERE requestID = ?");
    $getAppStmt->bind_param("i", $requestID);
    $getAppStmt->execute();
    $getAppStmt->bind_result($employeeID, $postID);
    if ($getAppStmt->fetch()) {
        $getAppStmt->close(); // CLOSE before running another query!
        // Update the post table to set the accepted employeeID
        $updatePostStmt = $connect->prepare("UPDATE post SET employeeID = ? WHERE postID = ?");
        $updatePostStmt->bind_param("si", $employeeID, $postID);
        $updatePostStmt->execute();
        $updatePostStmt->close();
    } else {
        $getAppStmt->close();
    }

    notifyEmployeeOnGigAccepted($connect, $requestID);
  } elseif ($action === 'decline') {
    $newStatus = 'Declined';
    notifyEmployeeOnGigDeclined($connect, $requestID);
  }
  if (isset($newStatus)) {
    $updateStmt = $connect->prepare("UPDATE application SET requestStatus = ? WHERE requestID = ?");
    $updateStmt->bind_param("si", $newStatus, $requestID);
    $updateStmt->execute();
    $updateStmt->close();
    // Refresh to show updated status
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
  }
}

// --- NOW RUN YOUR SELECT ---
$sql = "SELECT a.*, e.name AS employeeName, e.email AS employeeEmail, p.title AS postTitle
        FROM application a
        JOIN post p ON a.postID = p.postID
        LEFT JOIN employee e ON a.employeeID = e.employeeID
        WHERE p.employerID = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $employerID);
$stmt->execute();
$applicantsResult = $stmt->get_result();
echo "<!-- employerID in session: '" . htmlspecialchars($employerID) . "' -->";
echo "<!-- Number of applicants found: " . $applicantsResult->num_rows . " -->";
$stmt->close();

echo "<!-- Reached before HTML -->";

?>

<?php
/**
 * Notify employee when their gig application is accepted
 */
function notifyEmployeeOnGigAccepted($connect, $applicationID)
{
  $employeeID = null;
  $postTitle = null;
  $stmt = $connect->prepare("SELECT a.employeeID, p.title FROM application a JOIN post p ON a.postID = p.postID WHERE a.requestID = ?");
  $stmt->bind_param("i", $applicationID);
  $stmt->execute();
  $stmt->bind_result($employeeID, $postTitle);
  if ($stmt->fetch()) {
    $stmt->close(); // <-- CLOSE FIRST
    $message = "Your application for \"$postTitle\" has been accepted!";
    include_once("../addnotification.php");
    addNotification($employeeID, $message, "Gig Accepted", $_SESSION['employerID']);
  } else {
    $stmt->close();
  }
}

function notifyEmployeeOnGigDeclined($connect, $applicationID)
{
  // Get employeeID and post title
  $employeeID = null;
  $postTitle = null;
  $stmt = $connect->prepare("SELECT a.employeeID, p.title FROM application a JOIN post p ON a.postID = p.postID WHERE a.requestID = ?");
  $stmt->bind_param("i", $applicationID);
  $stmt->execute();
  $stmt->bind_result($employeeID, $postTitle);
  if ($stmt->fetch()) {
    $stmt->close();
    // Prepare notification message
    $message = "Your application for \"$postTitle\" has been declined!";
    // Call your notification function (adjust path if needed)
    include_once("../addnotification.php");
    addNotification($employeeID, $message, "Gig Declined", $employerID);
  } else {
    $stmt->close();
  }
}


// After you update the application status to 'Accepted', call:

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>View Applicants - GigIt</title>
  <link rel="stylesheet" href="../styling/stylegig.css">
  <link rel="stylesheet" href="../styling/stylePost.css">
  <style>
  </style>
</head>

<body class="lightmode">
  <div class="mid-section">
    <div class="applicant-container">
      <h2 class="title">Applicants</h2>
      <?php if ($applicantsResult->num_rows > 0): ?>
        <div class="applicant-list">
          <?php while ($app = $applicantsResult->fetch_assoc()): ?>
            <div class="applicant-card">
              <strong><?= htmlspecialchars($app['employeeName'] ?? $app['employeeID']) ?></strong>
              <?php if (!empty($app['employeeEmail'])): ?>
                (<?= htmlspecialchars($app['employeeEmail']) ?>)
              <?php endif; ?>
              <br>
              <em><?= htmlspecialchars($app['requestDetails']) ?></em>
              <br>
              Status: <span style="font-weight:bold;"><?= htmlspecialchars($app['requestStatus']) ?></span>
              <br>
              <span style="color:#888;">For Post: <?= htmlspecialchars($app['postTitle']) ?></span>
              <br><br>
              <?php if ($app['requestStatus'] === 'Pending'): ?>
                <div class="applicant-actions">
                  <form method="post" style="display:inline;">
                    <input type="hidden" name="action" value="accept">
                    <input type="hidden" name="requestID" value="<?= $app['requestID'] ?>">
                    <button type="submit" class="accept-btn">Accept</button>
                  </form>
                  <form method="post" style="display:inline;">
                    <input type="hidden" name="action" value="decline">
                    <input type="hidden" name="requestID" value="<?= $app['requestID'] ?>">
                    <button type="submit" class="decline-btn">Decline</button>
                  </form>
                </div>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <p>No applicants found.</p>
      <?php endif; ?>
    </div>
  </div>

</body>

</html>