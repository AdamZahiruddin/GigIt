<?php
 session_start();
 
 include("../nav.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Post - GigIt</title>
  <link rel="stylesheet" href="../stylegig.css">
  <link rel="stylesheet" href="../stylePost.css">

  <style>
  
  </style>
</head>
<body class="lightmode">

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
    <h2 class="create-title">Create Post</h2>
      <div class="create-container">
        <div class="form-content">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
  <?php
//session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION['title'] = $_POST['title'];
    $_SESSION['description'] = $_POST['description'];
    header("Location: createDetails.php");
    exit();
}
?>
</body>
</html>
