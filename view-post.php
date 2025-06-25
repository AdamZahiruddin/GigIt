<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GigIt</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>

<body>
    <?php
        include("./nav.php");
    ?>
    <h1 class="header-text">Manage Posts</h1>
    <?php
        require("./connect.php");

        echo "<div class='contain-contents'>";
        $result = $conn->query("SELECT * FROM post, employer WHERE post.employerID = employer.employerID");
        if($result->num_rows > 0){
            while($posts = $result->fetch_assoc()){
                echo "
                    <div class='content'>
                        <h3 class='name'>" . $posts["title"] . "</h3>
                        <p>Posted by: " . $posts['name'] . "</p>
                        <a href=''>View</a>
                    </div>
                ";
            }
            echo "</div>";
        }
    ?>
</body>

</html>