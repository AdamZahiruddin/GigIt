<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GigIt</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <?php
        include("./nav.php");
        require("./connect.php");
    ?>
    <h1 class="header-text">View Data: Posts</h1>
    <div class="contain-table">
        <h2>Posts Counts</h2>
        <table id="table-post-count">
            <tr>
                <th>Personal</th>
                <th>Community</th>
            </tr>
            <tr>
                <?php 
                    require("./connect.php");
                    $result = $conn->query("SELECT * FROM post WHERE gigType = 'Personal'");
                    $typePersonal = mysqli_num_rows($result);

                    $result = $conn->query("SELECT * FROM post WHERE gigType = 'Community'");
                    $typeCommunity = mysqli_num_rows($result);

                    echo "
                        <td>$typePersonal</td>
                        <td>$typeCommunity</td>                 
                    ";
                ?>
            </tr>
        </table>        
    </div>
</body>

</html>