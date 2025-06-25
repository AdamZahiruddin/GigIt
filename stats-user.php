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
        require("./connect.php");
    ?>
    <h1 class="header-text">View Data: Users</h1>
    <div class="contain-table">
        <table id="table-user-count">
            <h2>User Counts</h2>
            <tr>
                <th>Employee</th>
                <th>Employer</th>
                <th>Admin</th>
            </tr>
            <tr>
                <?php 
                    require("./connect.php");
                    $result = $conn->query("SELECT * FROM employee");
                    $employeeCount = mysqli_num_rows($result);

                    $result = $conn->query("SELECT * FROM employer");
                    $employerCount = mysqli_num_rows($result);

                    $result = $conn->query("SELECT * FROM admin");
                    $adminCount = mysqli_num_rows($result);

                    echo "
                        <td>$employeeCount</td>
                        <td>$employerCount</td>
                        <td>$adminCount</td>                    
                    ";
                ?>
            </tr>
        </table>        
    </div>
</body>

</html>