<?php
session_start();
include("../nav.php");
require("../inc/connect.php");

if (!isset($_SESSION['employerID']) || !isset($_SESSION['edit_post']['postID'])) {
    echo "Unauthorized access.";
    exit;
}

$postID = intval($_SESSION['edit_post']['postID']);
$employerID = $_SESSION['employerID'];


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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $salary = $_POST['salary'] ?? '';
    $location = $_POST['location'] ?? '';
    $date = $_POST['date'] ?? '';
    $type = $_POST['gig-type'] ?? '';
    $title = $_SESSION['edit_post']['title'];
    $description = $_SESSION['edit_post']['description'];

    $stmt = $connect->prepare("UPDATE post SET title=?, description=?, wages=?, location=?, date=?, gigtype=? WHERE postID=? AND employerID=?");
    $stmt->bind_param("ssssssss", $title, $description, $salary, $location, $date, $type, $postID, $employerID);
    if ($stmt->execute()) {
        unset($_SESSION['edit_post']);
        header("Location: managePosts.php");
        exit;
    } else {
        echo "Failed to update post.";
    }
    $stmt->close();
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
    <h2 class="create-title">Edit Post Details</h2>
    <div class="create-container">
      <div class="form-content">
        <form method="post">
          <div class="form-row">
            <label class="form-label" for="gig-salary">Salary:</label>
            <input class="text-box" id="gig-salary" name="salary" type="text" value="<?= htmlspecialchars($post['wages']) ?>" required />
          </div>
          <div class="form-row">
            <label class="form-label" for="gig-location">Location:</label>
            <input class="text-box" id="gig-location" name="location" type="text" value="<?= htmlspecialchars($post['location']) ?>" required />
          </div>
          <div class="form-row">
            <label class="form-label" for="gig-date">Date:</label>
            <input class="text-box" id="gig-date" name="date" type="text" value="<?= htmlspecialchars($post['date']) ?>" required />
          </div>
          <div class="form-row">
            <label class="form-label">Type:</label>
            <div class="radio-group">
              <label class="radio-label">
                <input type="radio" name="gig-type" value="Personal" <?= $post['gigtype'] === 'Personal' ? 'checked' : '' ?>>
                Personal
              </label>
              <label class="radio-label">
                <input type="radio" name="gig-type" value="Community" <?= $post['gigtype'] === 'Community' ? 'checked' : '' ?>>
                Community
              </label>
            </div>
          </div>
          <div class="form-actions">
            <button class="btn-create" id="btn-back" type="button" onclick="window.history.back();">Back</button>
            <button class="btn-create" id="btn-submit" type="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
