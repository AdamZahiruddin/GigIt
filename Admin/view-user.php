<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GigIt</title>
    <link rel="stylesheet" href="./style.css" type="text/css">
</head>

<body>
    <?php
        include("./nav.php");
    ?>
    <h1 class="header-text">Manage Users</h1>
    <?php
        require("./connect.php");
        echo "<div id='contain-users'>";
        $result = $conn->query("SELECT * FROM user");
        if($result->num_rows > 0){
            while($users = $result->fetch_assoc()){
                echo "
                    <div class='user'>
                        <h3 class='name'>" . $users["name"] . "</h3>
                        <a href=''>View</a>
                    </div>
                ";
            }
            echo "</div>";
        }
    ?>
</body>

</html>