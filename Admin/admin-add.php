<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GigIt</title>
    <link rel="stylesheet" href="./style.css">
</head>

<?php
    require("connect.php");
    session_start();
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashpassword = password_hash($password, PASSWORD_DEFAULT);

        $result = $conn->query("SELECT * FROM admin WHERE name = $username");
        if($result->num_rows == 0){
            $sql = "INSERT INTO admin (name, password) VALUES ('$username', '$hashpassword')";
            if($conn->query($sql)){
                header("Location: ./admin-login.php");
            }          
        }
        else{
            echo "User admin already exist";
        }
    }
?>

<body>
    <h1>GigIt</h1>
    <form action="./admin-add.php" method="post">
        <h2>Admin Add</h2>
        <div class="contain-input">
            <label for="username">Username: </label>
            <input type="text" name="username" id="username" required>            
        </div>
        <div class="contain-input">
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" required>            
        </div>
        <div id="contain-btns">
            <button type="submit">Add</button>
            <button type="reset">Clear</button>
        </div>
    </form>
</body>
</body>
</html>