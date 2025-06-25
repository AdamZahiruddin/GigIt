<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Review Applicant - GigIt</title>
  <link rel="stylesheet" href="stylegig.css">
  <link rel="stylesheet" href="stylePost.css">

  <style>
  
  </style>
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
      <!-- Reusable Search Bar -->
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
      <div class="applicant-container">
        <div class="form-content">
          <form action="">
            <div class="form-actions">
              <button class="btn-applicant" id="btn-decline" type="button"></button>
              <button class="btn-applicant" id="btn-accept" type="submit"></button>
            </div>
          </form>
        </div>
      </div>
  </div>
</body>
</html>
