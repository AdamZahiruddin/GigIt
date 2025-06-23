<?php
session_start();
require("connect.php");

if (isset($_POST['salary'], $_POST['location'], $_POST['date'], $_POST['gig-type'])) {
    $title = $_SESSION['title'] ?? ($_POST['title'] ?? '');
    $description = $_SESSION['description'] ?? ($_POST['description'] ?? '');
    $salary = $_POST['salary'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $type = $_POST['gig-type'];

    if ($title && $description && $salary && $location && $date && $type) {
        $sql = "INSERT INTO post (title, description, wages, location, date, gigtype) 
                VALUES ('$title','$description', '$salary', '$location', '$date','$type')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            echo "<meta http-equiv='refresh' content='3;URL=managePosts.php'>";
        } else {
            echo "Error: " . $conn->error;
        }
        $conn->close();
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}
?>

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
    <h2 class="create-title">Create Post</h2>
      <div class="create-container">
        <div class="form-content">
          <form action="createDetails.php" method="POST">
            <div class="form-row">
              <label class="form-label" for="gig-salary">Wages:</label>
              <input class="text-box" id="gig-salary" name = "salary" type="text"/>
            </div>
            <div class="form-row">
              <label class="form-label" for="gig-location">Location:</label>
              <input class="text-box" id="gig-location" name="location"type="text"/>
            </div>
            <div class="form-row">
              <label class="form-label" for="gig-date">Date:</label>
              <input class="text-box" id="gig-date" name="date"type="text" placeholder="2xxx-x-xx"/>
            </div>
            <div class="form-row">
              <label class="form-label">Type:</label>
              <div class="radio-group">
                <label class="radio-label">
                  <input type="radio" name="gig-type" value="Personal" checked>
                  Personal
                </label>
                <label class="radio-label">
                  <input type="radio" name="gig-type" value="Community">
                  Community
                </label>
              </div>
            </div>
            <div class="form-actions">
              <button class="btn-back" type="button">Back</button>
              <button class="btn-submitgig" type="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</body>
</html>
