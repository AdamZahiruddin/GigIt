<?php
require("connect.php");

$results = [];

if (isset($_GET['search'])) {
    $keyword = strtolower(trim($_GET['search']));
    $searchTerm = "%" . $keyword . "%";

    // Simple search using LIKE and LOWER (not using prepared statements, as requested)
    $sql = "SELECT * FROM post WHERE LOWER(title) LIKE '$searchTerm'";
    $query = $conn->query($sql);

    while ($row = $query->fetch_assoc()) {
        $results[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Similar Posts - GigIt</title>
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
      <form class="search-bar" action="searchedPost.php" method="get">
        <input type="text" id="searchinput" name="name" placeholder="Search..." required>
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
    <h2 class="create-title">Similar Posts</h2>

    <?php if (!empty($results)): ?>
      <?php foreach ($results as $post): ?>
        <div class="post-containers">
          <a href="viewPost.php?postID=<?= $post['postID'] ?>"><h2><?= htmlspecialchars($post['title']) ?></h2></a>
          <p><?= htmlspecialchars($post['description']) ?></p>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p style="margin-left: 2rem;">No results found for "<strong><?= htmlspecialchars($_GET['search'] ?? '') ?></strong>".</p>
    <?php endif; ?>
  </div>
</body>
</html>
