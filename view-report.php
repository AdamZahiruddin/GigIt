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
    <h1 class="header-text">Manage Reports</h1>
    <?php
        require("./connect.php");

        echo "<div class='contain-contents'>";
        $result = $conn->query("SELECT * FROM report ORDER BY reportID DESC");
        if($result->num_rows > 0){
            while($reports = $result->fetch_assoc()){
                $reportID = $reports['reportID'];
                if(!is_null($reports['employeeID'])){
                    $sql = "SELECT * FROM report, employee WHERE report.employeeID = employee.employeeID AND report.reportID = $reportID";
                    $resultUser = $conn->query($sql);
                    $report = $resultUser->fetch_assoc();
                    echo "
                        <div class='content'>
                            <h3 class='name'>User '" . $report['name'] . "' reported!</h3>
                            <p>Report Description: " . $report['reportDescription'] . " </p>
                            <a href=''>View</a>
                        </div>
                    ";
                }
                else if(!is_null($reports['employerID'])){
                    $sql = "SELECT * FROM report, employer WHERE report.employerID = employer.employerID AND report.reportID = $reportID";
                    $resultUser = $conn->query($sql);
                    $report = $resultUser->fetch_assoc();
                    echo "
                        <div class='content'>
                            <h3 class='name'>User '" . $report['name'] . "' reported!</h3>
                            <p>Report Description: " . $report['reportDescription'] . " </p>
                            <a href=''>View</a>
                        </div>
                    ";
                }
                else if(!is_null($reports['postID'])){
                    $sql = "SELECT * FROM report, post WHERE report.postID = post.postID AND report.reportID = $reportID";
                    $resultPost = $conn->query($sql);
                    $report = $resultPost->fetch_assoc();
                    echo "
                        <div class='content'>
                            <h3 class='name'>User post reported!</h3>
                            <p>Report Description: " . $report['reportDescription'] . "</p>
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