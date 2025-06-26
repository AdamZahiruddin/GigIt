<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<nav class="sidebar">
  <div class="logo light">GigIt</div>
  <a href="/Gigit/Profile/profile.php">Profile</a>
  <?php if (isset($_SESSION['employerID'])): ?>
    <!-- Employer navigation -->
    <a href="/Gigit/GigPosts/managePosts.php">Manage Posts</a>
    <a href="/Gigit/GigPosts/createPost.php">Create Post</a>
    <a href="/GigIt/GigPosts/viewApplicants.php">Applicants</a>
    <a href="/GigIt/Rating/listUser.php">Previous Employees</a>
    <span style="color: #888; margin-left: 10px;">(Logged in as Employer)</span>
    <a href="/Gigit/Login/logout.php" style="color: #c0392b; margin-left: 10px;">Logout</a>
  <?php elseif (isset($_SESSION['employeeID'])): ?>
    <!-- Employee navigation -->
    <a href="/Gigit/homePage.php">Home</a>
    <a href="/Gigit/GigPosts/requested.php">Requested Gigs</a>
    <a href="/Gigit/GigPosts/currentGig.php">My Current Gig</a>
    <span style="color: #888; margin-left: 10px;">(Logged in as Employee)</span>
    <a href="/Gigit/Login/logout.php" style="color: #c0392b; margin-left: 10px;">Logout</a>
  <?php else: ?>
    <!-- Not logged in -->
    <a href="../index.php">Login</a>
  <?php endif; ?>
</nav>