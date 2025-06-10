<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css" type="text/css">
    <title>Gigit</title>
</head>
<body>
    <?php 
        include('nav.php');
    ?>
    <div id="contain-all-posts">
    <?php
        require('connect.php');
        
        $posts = $conn->query("SELECT * FROM post");
        foreach($posts as $post){
            $postTitle = $post['title'];
            $postSalary = $post['salary'];
            $postDate = $post['date'];
            echo "    
                <div class='contain-post'>
                    <h2>$postTitle</h2>
                    <div class='contain-info'>
                        <p class='salary'>$postSalary</p>
                        <p class='date'>$postDate</p>
                    </div>
                </div>";
        }
    ?>
    </div>
</body>
</html>