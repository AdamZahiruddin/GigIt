<?php
session_start();
require("inc/connect.php");

if (!isset($_SESSION['username'])) {
    echo "You must be logged in to view this page.";
    exit;
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM post WHERE publisher = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Posts - GigIt</title>
  <link rel="stylesheet" href="stylegig.css">
  <link rel="stylesheet" href="stylePost.css">
</head>
<body class="lightmode">
  
  <nav class="sidebar">
    <div class="logo light">GigIt</div>
    <a href="home.html">Home</a>
    <a href="Recents.php">Recently Posted</a>
    <a href="Foryou.html">For you</a>
    <a href="trending.html">Trending Gigs</a>
  </nav>

  <div class="top-bar">
    <div class="search-notify-container">
      <form class="search-bar" action="search.html" method="get">
        <input type="text" id="searchinput" name="search" placeholder="Search...">
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
    <h2 class="create-title">Manage Posts</h2>

    <?php if ($result->num_rows > 0): ?>
      <?php while ($post = $result->fetch_assoc()): ?>
        <div class="post-containers">
          <h3><?= htmlspecialchars($post['title']) ?></h3>
          <p><?= htmlspecialchars($post['description']) ?></p>
          <p><strong>Date:</strong> <?= htmlspecialchars($post['date']) ?></p>
          <p><strong>Wage:</strong> <?= htmlspecialchars($post['wages']) ?></p>
          <a href="viewPost.php?postID=<?= $post['postID'] ?>">View</a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No posts found.</p>
    <?php endif; ?>
  </div>
</body>
</html>
