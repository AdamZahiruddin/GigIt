<?php
session_start();
include("../nav.php");
require("../inc/connect.php");

if (!isset($_SESSION['employerID'])) {
    echo "You must be logged in as an employer to edit a post.";
    exit;
}

if (!isset($_GET['postID'])) {
    echo "No post selected.";
    exit;
}

$postID = intval($_GET['postID']);
$employerID = $_SESSION['employerID'];

// Fetch post data
$stmt = $connect->prepare("SELECT * FROM post WHERE postID = ? AND employerID = ?");
$stmt->bind_param("is", $postID, $employerID);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo "Post not found or you do not have permission to edit this post.";
    exit;
}
$post = $result->fetch_assoc();
$stmt->close();

// On submit, save changes and redirect to editDetails.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $_SESSION['edit_post'] = [
        'postID' => $postID,
        'title' => $title,
        'description' => $description
    ];
    header("Location: editDetails.php?postID=$postID");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Post - GigIt</title>
  <link rel="stylesheet" href="../styling/stylegig.css">
  <link rel="stylesheet" href="../styling/stylePost.css">
</head>
<body class="lightmode">
  <?php include("../topbar.php");?>
  <div class="mid-section">
    <h2 class="create-title">Edit Post</h2>
    <div class="create-container">
      <div class="form-content">
        <form method="post">
          <div class="form-row">
            <label class="form-label" for="gig-title">Gig Title:</label>
            <input class="text-box" id="gig-title" name="title" type="text" value="<?= htmlspecialchars($post['title']) ?>" required />
          </div>
          <div class="form-row">
            <label class="form-label" for="gig-desc">Gig Description:</label>
            <textarea class="text-box" id="gig-desc" name="description" required><?= htmlspecialchars($post['description']) ?></textarea>
          </div>
          <div class="form-actions">
            <button class="btn-create" id="btn-back" type="button" onclick="window.history.back();">Back</button>
            <button class="btn-create" type="submit">Next</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
