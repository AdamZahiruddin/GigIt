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
        require("inc/connect.php");
    ?>
    <h1 class="header-text">View Data: Reports</h1>
    <div class="contain-table">
        <table id="table-reports-count">
            <h2>Report Counts</h2>
            <tr>
                <th>Report on Employee</th>
                <th>Report on Employer</th>
                <th>Report on Post</th>
            </tr>
            <tr>
                <?php 
                    require("./connect.php");
                    $result = $conn->query("SELECT * FROM report WHERE employeeID IS NOT NULL");
                    $reportEmployee = mysqli_num_rows($result);

                    $result = $conn->query("SELECT * FROM report WHERE employerID IS NOT NULL");
                    $reportEmployer = mysqli_num_rows($result);

                    $result = $conn->query("SELECT * FROM report WHERE postID IS NOT NULL");
                    $reportPost = mysqli_num_rows($result);

                    echo "
                        <td>$reportEmployee</td>
                        <td>$reportEmployer</td>
                        <td>$reportPost</td>                
                    ";
                ?>
            </tr>
        </table>        
    </div>
</body>

</html>