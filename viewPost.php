<?php
require("connect.php");

$post = null;

if (isset($_GET['postID'])) {
    $post_id = intval($_GET['postID']); // basic safety
    $sql = "SELECT * FROM post WHERE postID = $post_id";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $post = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Post - GigIt</title>
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
    <div class="post-container">
      <div class="post-content">
        <h2><?= htmlspecialchars($post['title'] ?? 'Post not found') ?></h2>
        <h3><?= htmlspecialchars($post['description'] ?? '') ?></h3>
        <form action="">
          <div class="form-actions">
            <div class="publisher-box">
              <img class="imgProfile" src="" alt="Profile Picture"/>
              <span class="username"><?= htmlspecialchars($post['publisher'] ?? '') ?></span>
            </div>
            <div class="action-buttons">
              <button class="btn-create" type="button" onclick="history.back()">Back</button>
              <button class="btn-create" type="submit">Request</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="details-container">
      <div class="details-row"><span class="details-label">Contact:</span><span class="details-value"><?= htmlspecialchars($post['contact'] ?? '') ?></span></div>
      <div class="details-row"><span class="details-label">Location:</span><span class="details-value"><?= htmlspecialchars($post['location'] ?? '') ?></span></div>
      <div class="details-row"><span class="details-label">Wage:</span><span class="details-value"><?= htmlspecialchars($post['wages'] ?? '') ?></span></div>
      <div class="details-row"><span class="details-label">Date:</span><span class="details-value"><?= htmlspecialchars($post['date'] ?? '') ?></span></div>
    </div>

    <div class="map-container">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.123456789!2d102.2512345!3d2.3123456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1f123456789ab%3A0xabcdefabcdef1234!2sUniversiti%20Teknikal%20Malaysia%20Melaka!5e0!3m2!1sen!2smy!4v1680000000000!5m2!1sen!2smy"
        width="600" height="350" style="border:0; border-radius: 16px;" allowfullscreen="" loading="lazy">
      </iframe>
    </div>
  </div>
</body>
</html>
