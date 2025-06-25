<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GigIt</title>
    <link rel="stylesheet" href="./stylegig.css">
</head>
<body>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>
    <nav class="sidebar">
    <div class="logo light">GigIt</div>
    <a href="profile.php">Profile</a>
    <?php if (isset($_SESSION['employerID'])): ?>
        <!-- Employer navigation -->
        <a href="/Gigit/GigPosts/managePosts.php">Manage Posts</a>
        <a href="/Gigit/GigPosts/createPost.php">Create Post</a>
        <a href="/GigIt/GigPosts/viewApplicants.php">Applicants</a>
        <span style="color: #888; margin-left: 10px;">(Logged in as Employer)</span>
        <a href="/Gigit/Login/logout.php" style="color: #c0392b; margin-left: 10px;">Logout</a>
    <?php elseif (isset($_SESSION['employeeID'])): ?>
        <!-- Employee navigation -->
        <a href="/Gigit/homePage.php">Home</a>
        <a href="/Gigit/GigPosts/requested.php">Requested Gigs</a>
        <a href="/Gigit/GigPosts/currentGig.php">My Current Gig</a>
        <span style="color: #888; margin-left: 10px;">(Logged in as Employee)</span>
        <a href="/Gigit/Login/logout.php" style="color: #c0392b; margin-left: 10px;">Logout</a>
    <?php elseif (isset($_SESSION['adminID'])):?>
        <!-- Admin navigation -->
        <a href="./admin.php">Home</a>
        <a href="./view-user.php">Manage Users</a>
        <a href="./view-post.php">Manage Posts</a>
        <a href="./view-report.php">Manage Reports</a>
        <a href="./view-stats.php">View Statistics</a>
        <span style="color: #888; margin-left: 10px;">(Logged in as Admin)</span>
        <a href="./logout.php" style="color: #c0392b; margin-left: 10px;">Logout</a>
    <?php else:?>
        <!-- Not logged in -->
        <a href="Login/index.php">Login</a>
    <?php endif; ?>
    </nav>
</body>
</html>