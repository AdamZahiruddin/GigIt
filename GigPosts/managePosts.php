<?php
session_start();
echo "<!-- SESSION DEBUG: ";
print_r($_SESSION);
echo " -->";

require("../inc/connect.php");
include("../nav.php");

if (!isset($_SESSION['employerID'])) {
  echo "You must be logged in as an employer to view this page.";
  exit;
}

$employerID = $_SESSION['employerID'];

// Handle mark as completed
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complete_postID'])) {
  $completeID = intval($_POST['complete_postID']);
  // Get the accepted employeeID for this post
  $stmt = $connect->prepare("SELECT employeeID FROM post WHERE postID = ?");
  $stmt->bind_param("i", $completeID);
  $stmt->execute();
  $stmt->bind_result($employeeID);
  $stmt->fetch();
  $stmt->close();

  // Mark the post as completed
  $stmt = $connect->prepare("UPDATE post SET status = 'Completed' WHERE postID = ? AND employerID = ?");
  $stmt->bind_param("is", $completeID, $employerID);
  $stmt->execute();
  $stmt->close();

  // Redirect to rating page with employeeID
  header("Location: /Gigit/Rating/rating.php?employeeID=" . urlencode($employeeID));
  exit;
}

$sql = "SELECT * FROM post WHERE employerID = ? AND status != 'Deactivated'";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $employerID); // i for int s for string
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Manage Posts - GigIt</title>
  <link rel="stylesheet" href="../styling/stylegig.css">
  <link rel="stylesheet" href="../styling/stylePost.css">
</head>

<body class="lightmode">

  <div class="mid-section">
    <h2 class="create-title">Manage Posts</h2>
    <div>
      <?php if ($result->num_rows > 0): ?>
        <?php while ($post = $result->fetch_assoc()): ?>
          <div class="post-containers" style="">
            <div class="post-header" style="display: flex; justify-content: space-between; align-items: center;">
              <span class="post-title"
                style="font-size: 1.3rem; font-weight: bold;"><?= htmlspecialchars($post['title']) ?></span>
              <span class="post-status"
                style="color:<?= $post['status'] === 'Completed' ? 'green' : '#e67e22' ?>; font-weight:bold;">
                <?= htmlspecialchars($post['status']) ?>
              </span>
            </div>
            <div class="post-meta" style="margin: 8px 0 12px 0; color: #555;">
              <span><strong>Date:</strong> <?= htmlspecialchars($post['date']) ?></span> &nbsp;|&nbsp;
              <span><strong>Wage:</strong> <?= htmlspecialchars($post['wages']) ?></span>
            </div>
            <div class="post-desc" style="margin-bottom: 16px;">
              <?= nl2br(htmlspecialchars($post['description'])) ?>
            </div>
            <div class="post-actions" style="display: flex; justify-content: flex-end;">
              <?php if (!empty($post['employeeID']) && $post['status'] !== 'Completed'): ?>
                <form method="post" style="display:inline;">
                  <input type="hidden" name="complete_postID" value="<?= $post['postID'] ?>">
                  <button type="submit" class="complete-btn"
                    style="background:#27ae60; color:#fff; border:none; padding:6px 14px; border-radius:5px; cursor:pointer;">
                    Mark as Completed
                  </button>
                </form>
              <?php elseif ($post['status'] === 'Completed'): ?>
                <button class="complete-btn" disabled
                  style="background: #ccc; color: #fff; border: none; padding: 6px 14px; border-radius: 5px; cursor: not-allowed;">
                  Mark as Completed
                </button>
                <span style="color:green; margin-left:8px;">Already completed</span>
              <?php else: ?>
                <button class="complete-btn" disabled
                  style="background: #ccc; color: #fff; border: none; padding: 6px 14px; border-radius: 5px; cursor: not-allowed;">
                  Mark as Completed
                </button>
                <span style="color:#e67e22; margin-left:8px;">Assign an employee first</span>
              <?php endif; ?>
              <a href="editPost.php?postID=<?= $post['postID'] ?>" class="edit-btn">Edit</a>
              <a href="deletePost.php?postID=<?= $post['postID'] ?>" class="delete-btn"
                onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No posts found.</p>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>