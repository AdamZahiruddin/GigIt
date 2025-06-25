<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GigIt</title>
    <link rel="stylesheet" href="./styling/style.css">
</head>

<body>
    <?php
        include("./nav.php");
        require("inc/connect.php");
    ?>
    <h1 class="header-text">View Data: All</h1>
    <div class="contain-table">
        <table id="table-user-count">
            <h2>User Counts</h2>
            <tr>
                <th>Employee</th>
                <th>Employer</th>
                <th>Admin</th>
            </tr>
            <tr>
                <td>3</td>
                <td>4</td>
                <td>5</td>
            </tr>
        </table>        
    </div>
    <br>
    <div class="contain-table">
        <h2>Posts Counts</h2>
        <table id="table-post-count">
            <tr>
                <th>Personal</th>
                <th>Community</th>
            </tr>
            <tr>
                <td>3</td>
                <td>4</td>
            </tr>
        </table>        
    </div>
    <br>
    <div class="contain-table">
        <table id="table-reports-count">
            <h2>Report Counts</h2>
            <tr>
                <th>Report on Users</th>
                <th>Report on Posts</th>
            </tr>
            <tr>
                <td>3</td>
                <td>4</td>
            </tr>
        </table>        
    </div>
</body>

</html>