<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GigIt</title>
    <link rel="stylesheet" href="./style2.css">
</head>

<?php
    require("connect.php");
    session_start();
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = $conn->query("SELECT * FROM admin WHERE email = '$email'");
        if($result->num_rows > 0){
            $user = $result->fetch_assoc();
            $hashpassword = $user['password'];

            if(password_verify($password, $hashpassword)){
            $_SESSION['username'] = $user['name'];
            $_SESSION['adminID'] = $user['adminID'];
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
    <header class="logo">
        GigIt
    </header>
    <section class="mid-section">
        <form class="container" action="./admin-login.php" method="post">

            <h2 style="margin-bottom: auto; text-align: left;">Admin Login</h2>
            
            <div class="contain-input">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required>
            </div>

            <div class="contain-input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div id="contain-buttons">
                <button type="submit">Log In</button>
                <button type="reset">Clear</button>
            </div>

            <span class="subtext">Add more admin account? Try <a href="./admin-add.php">Add</a></span>
        </form>
    </section>

</body>

</html>