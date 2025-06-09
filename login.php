<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>GigIt</title>
</head>

<?php 
    require('connect.php');
    session_start();

    if(isset($_POST['email'])){
        if($_POST['userType'] == 1){
            $result = $conn->query("SELECT * FROM employee");
            while($user = $result->fetch_assoc()){
                if($_POST['email'] == $user['email'] AND password_verify($_POST['password'], $user['password'])){
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['userType'] = 1;
                    header("Location: home.php");
                }
            }
        }
        else{
            $result = $conn->query("SELECT * FROM employer");
            while($user = $result->fetch_assoc()){
                if($_POST['email'] == $user['email'] AND password_verify($_POST['password'], $user['password'])){
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['userType'] = 2;
                    header("Location: home.php");
                }
            }
        }
        echo "Login failed! Please try again!";
    }
?>

<body>
    <header>
        <h1>GigIt</h1>
    </header>
    <form action="./login.php" method="post">
        <h2>Log In</h2>
        <div class="contain-input">
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="contain-input">
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="contain-input">
            <label for="userType">Sign in as: </label>
            <input type="radio" name="userType" id="employee" value="1" checked>
            Employee
            <input type="radio" name="userType" id="employer" value="2">
            Employer
        </div>
        <div id="contain-buttons">
            <button type="submit">Log In</button>
            <button type="reset">Clear</button>
        </div>
    </form>
</body>
</html>