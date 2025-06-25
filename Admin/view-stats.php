<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GigIt</title>
    <link rel="stylesheet" href="./styling/style.css" type="text/css">
</head>
<body>
    <?php
        include("./nav.php");
        require("inc/connect.php");
    ?>
    <h1 class="header-text">Statistics</h1>
    <section id="section-stats">
        <div id="user-distribute">
            <h2>User Distribution:</h2>
            <div id="contain-chart">
                <div id="chart"></div>
                <div id="chart-users">
                    <div class="contain-info">
                        <div class="info" id="employee"></div>
                        <p>Employee</p>
                    </div>
                    <div class="contain-info">
                        <div class="info" id="employer"></div>
                        <p>Employer</p>
                    </div>
                    <div class="contain-info">
                        <div class="info" id="admin"></div>
                        <p>Admin</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="contain-data">
            <h2>Show data:</h2>
            <div id="data-tabs">
                <a href="./stats-user.php">Users</a>
                <a href="./stats-post.php">Gig Posts</a>
                <a href="./stats-report.php">Reports</a>
            </div>
            <a href="./overall-report.php" id="generate-report"><b>Generate Overall Report</b></a>
        </div>
    </section>

</body>
</html>