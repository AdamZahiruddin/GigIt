
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Post - GigIt</title>
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
      <form class="search-bar" action="search.php" method="get">
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
    <h2 class="create-title">Create Post</h2>
      <div class="create-container">
        <div class="form-content">
          <form action="createDetails.php" method="post">
            <div class="form-row">
            <label class="form-label" for="gig-title">Gig Title:</label>
            <input class="text-box" id="gig-title" name = "title" type="text" />
          </div>
          <div class="form-row">
            <label class="form-label" for="gig-desc">Gig Description:</label>
            <textarea class="text-box" id="gig-desc" name="description"></textarea>
          </div>
          <div class="form-actions">
            <button class="btn-next" type="submit">Next</button>
          </div>
          </form>
        </div>
      </div>
  </div>
</body>
</html>
