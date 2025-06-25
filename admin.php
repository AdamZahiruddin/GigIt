<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GigIt</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
    <?php include("./nav.php");?>
    <h1 class="header-text">Admin Dashboard</h1>
    <div id="content-tabs">
        <div class="tabs">
            <h2>View Users</h2>
            <a class="btn-tabs" href="./view-user.php">View</a>
        </div>
        <div class="tabs">
            <h2>View Posts</h2>
            <a class="btn-tabs" href="./view-post.php">View</a>
        </div>
        <div class="tabs">
            <h2>View Reports</h2>
            <a class="btn-tabs" href="./view-report.php">View</a>
        </div>
        <div class="tabs">
            <h2>View Statistics</h2>
            <a class="btn-tabs" href="./view-stats.php">View</a>
        </div>
    </div>
</body>
</html>