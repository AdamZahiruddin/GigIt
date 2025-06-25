<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>GigIt - Your Gig, Your Rules</title>
  <link rel="stylesheet" href="stylegig.css">
  <link rel="stylesheet" href="stylePost.css">

  <style>
    .search-home-container {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        width: 900px;
        height: 60px;
        border-radius: 20px;
        background-color: #b3d3f6;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
    }    
    h1
    {
      position: fixed;
        top: 30%;
        left: 70%;
        transform: translate(-50%, -50%);
        display: flex;
        width: 900px;
        height: 60px;
        align-items: center;
        padding: 0 20px;
    }
    h2{
        position: fixed;
        top: 40%;
        left: 67%;
        transform: translate(-50%, -50%);
        display: flex;
        width: 900px;
        height: 60px;
        align-items: center;
        padding: 0 20px;
    }
  </style>
</head>
<body class="lightmode">
  <!--<img src="Images\GigIt Logo.png" class="logo">-->
  <h1>GigIt</h1>
  <h2>Your Gig, Your Rules</h2>
  <div class="top-bar">
    <div class="search-home-container">
      <!-- Reusable Search Bar -->
      <form class="search-bar" action="GigPosts/searchedPost.php" method="get">
        <input type="text" id="searchinput" name="name" placeholder="Search..." value="<?= htmlspecialchars($_GET['name'] ?? '') ?>" required>
        <button id="searchsubmit" type="submit">
          <img src="https://cdn-icons-png.flaticon.com/512/622/622669.png" alt="Search" width="20" height="20">
        </button>
      </form>
      <form action="GigPosts/currentGig.php" method="get" style="margin: 0;">
        <button type="submit" class="my-gigs-btn">
          My Gigs
        </button>
      </form>
      <button class="notification-btn">
        <img src="https://cdn-icons-png.flaticon.com/512/1827/1827392.png" alt="Notifications" width="24" height="24">
        <span class="notification-badge">0</span>
      </button>
    </div>
  </div>
</body>
</html>
