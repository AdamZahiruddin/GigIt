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
                <h1>GigIt</h1>
            </header>
        ";
        if($_SESSION['userType'] == 1){
            echo "
                <nav id='navigation-bar'>
                    <a href=''>View Post</a>
                    <a href=''>Apply Gig</a>
                </nav>
            ";
        }
        else{
        echo "
                <nav id='navigation-bar'>
                    <a href='create.php'>Create Post</a>
                    <a href=''>Edit Post</a>
                    <a href=''>View Application</a>
                </nav>
            ";
        }
    ?>
    <a href="./logout.php">Logout</a>
</body>
</html>