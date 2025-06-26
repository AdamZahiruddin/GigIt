<?php
session_start();
require("../inc/connect.php");
include("../nav.php");

if (!isset($_SESSION['employerID'])) {
    echo "You must be logged in as an employer to create a post.";
    exit;
}

if (isset($_POST['salary'], $_POST['location'], $_POST['date'], $_POST['gig-type'])) {
    $title = $_SESSION['title'] ?? ($_POST['title'] ?? '');
    $description = $_SESSION['description'] ?? ($_POST['description'] ?? '');
    $salary = $_POST['salary'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $type = $_POST['gig-type'];
    $employerID = $_SESSION['employerID'];
    $contact = '';
    $empResult = $connect->query("SELECT phone FROM employer WHERE employerID = '$employerID'");
    if ($empResult && $empResult->num_rows > 0) {
        $contact = $empResult->fetch_assoc()['phone'];
    }

    if ($title && $description && $salary && $location && $date && $type && $employerID) {
        $sql = "INSERT INTO post (title, description, wages, location, date, gigtype, employerID, status, contact) 
                VALUES ('$title','$description', '$salary', '$location', '$date','$type', '$employerID', 'In-Progress', '$contact')";
        if ($connect->query($sql) === TRUE) {
            echo "New record created successfully";
            echo "<meta http-equiv='refresh' content='2;URL=managePosts.php'>";
        } else {
            echo "Error: " . $connect->error;
        }
        $connect->close();
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
  <link rel="stylesheet" href="../styling/stylegig.css">
  <link rel="stylesheet" href="../styling/stylePost.css">

  <style>
  
  </style>
</head>
<body class="lightmode">


  <?php include("../topbar.php");?>
    
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
