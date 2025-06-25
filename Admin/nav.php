<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GigIt</title>
</head>
<body>
    <?php 
        session_start();
        echo "
            <header>
                <h1><a href='home.php' id='title'>GigIt</a></h1>
            </header>
        ";
        if($_SESSION['role'] == 0){
            echo "
                <nav id='navigation-bar'>
                    <a href='./admin.php'>Home</a>
                    <a href='./view-user.php'>View Users</a>
                    <a href='./view-post.php'>View Posts</a>
                    <a href='./view-report.php'>View Reports</a>
                    <a href='./view-stats.php'>View Statistics</a>
                    <a href='./logout.php'>Logout</a>
                </nav>
            ";
        }
        else if($_SESSION['role'] == 1){
            echo "
                <nav id='navigation-bar'>
                    <a href=''>View Post</a>
                    <a href=''>Apply Gig</a>
                    <a href='./logout.php'>Logout</a>
                </nav>
            ";
        }
        else{
            echo "
                <nav id='navigation-bar'>
                    <a href='create.php'>Create Post</a>
                    <a href=''>Edit Post</a>
                    <a href=''>View Application</a>
                    <a href='./logout.php'>Logout</a>
                </nav>
            ";
        }
    ?>
</body>
</html>