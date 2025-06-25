<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylegig.css">
    <title>GigIt</title>
    <style>
        .logout{
            position: absolute;
            top: 60px;
            left: 30px;
        }
    </style>
</head>

<body>
    <?php


    //get usertype from database to session
    
    $_SESSION['userType'] = 1; // This should be set based on the logged-in user's type
    //test for usertype 1
    echo "
            <header>
                <div class='logo light'>GigIt</div>
                <a class='logout' href='./logout.php'>Logout</a>
            </header>
        ";
    if ($_SESSION['userType'] == 1) {
        echo "
                <nav class='sidebar'>
                    <a href='home.php'>Home</a>
                    <a href='profile.php'>Profile</a>

                </nav>
            ";
    } else {
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