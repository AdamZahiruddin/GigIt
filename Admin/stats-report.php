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
    <h1 class="header-text">View Data: Reports</h1>
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