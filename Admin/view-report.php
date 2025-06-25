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
    <h1 class="header-text">Manage Reports</h1>
    <?php
        require("./connect.php");

        echo "<div class='contain-contents'>";
        $result = $conn->query("SELECT * FROM reports ORDER BY reportsID DESC");
        if($result->num_rows > 0){
            while($reports = $result->fetch_assoc()){
                $reportsID = $reports['reportsID'];
                if(!is_null($reports['userID'])){
                    $sql = "SELECT * FROM reports, user WHERE reports.userID = user.user_id AND reports.reportsID = $reportsID";
                    $resultUser = $conn->query($sql);
                    $report = $resultUser->fetch_assoc();
                    echo "
                        <div class='content'>
                            <h3 class='name'>User '" . $report['name'] . "' reported!</h3>
                            <p>Report Description: " . $report['description'] . " </p>
                            <a href=''>View</a>
                        </div>
                    ";
                }
                else if(!is_null($reports['postID'])){
                    $sql = "SELECT * FROM reports, post WHERE reports.postID = post.PostID AND reports.reportsID = $reportsID";
                    $resultPost = $conn->query($sql);
                    $report = $resultPost->fetch_assoc();
                    echo "
                        <div class='content'>
                            <h3 class='name'>User post reported!</h3>
                            <p>Report Description: " . $report['description'] . "</p>
                            <a href=''>View</a>
                        </div>
                    ";
                }
            }
            echo "</div>";
        }
    ?>
</body>
</html>