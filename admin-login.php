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

        $result = $conn->query("SELECT * FROM admin WHERE name = '$username'");
        if($result->num_rows > 0){
            $user = $result->fetch_assoc();
            $hashpassword = $user['password'];

            if(password_verify($password, $hashpassword)){
                $_SESSION['username'] = $username;
                $_SESSION['role'] = '0';
                header("Location: ./admin.php");                
            }
            else{
                echo "Incorrect username or password";
            }
        }
        else{
            echo "Login failed! incorrect information";
        }
    }
?>

<body>
    <h1>GigIt</h1>
    <form action="./admin-login.php" method="post">
        <h2>Admin Login</h2>
        <div class="contain-input">
            <label for="username">Username: </label>
            <input type="text" name="username" id="username" required>            
        </div>
        <div class="contain-input">
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" required>            
        </div>
        <div id="contain-btns">
            <button type="submit">Log In</button>
            <button type="reset">Clear</button>
        </div>
    </form>
</body>

</html>