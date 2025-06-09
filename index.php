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
    if(isset($_SESSION['email'])){
        header("Location: home.php");
    }

    if(isset($_POST['email'])){
        
        $result = $conn->query("SELECT * FROM employee ");
        if($result->num_rows > 0){
            while($user = $result->fetch_assoc()){
                if($_POST['email'] == $user['email']){
                    session_destroy();
                    header('Location: login.php');
                }
            }
            post();
        }
        else{
            $result = $conn->query("SELECT * FROM employer");
            if($result->num_rows > 0){
                while($user = $result->fetch_assoc()){
                    if($_POST['email'] == $user['email']){
                        session_destroy();
                        header('Location: login.php');
                    }
                }
                post();
            }
            else{
                post();
            }
        }
    }

    function post(){
        require('connect.php');
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $userType = $_POST['userType'];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if($userType == 1){
            $sql = "INSERT INTO employee (name, email, phone, password, userType) VALUES ('$name', '$email', '$phone', '$hashedPassword', 'employee')";
        }
        else{
            $sql = "INSERT INTO employer (name, email, phone, password, userType) VALUES ('$name', '$email', '$phone', '$hashedPassword', 'employer')";
        }

        if($conn->query($sql)){
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['userType'] = $_POST['userType'];
            $conn->close();
            header("Location: home.php");
        }

        $conn->close();
    }
?>

<body>
    <header>
        <h1>GigIt</h1>
    </header>
    <form action="./index.php" method="post">
        <h2>Sign Up</h2>
        <div class="contain-input">
            <label for="name">Name: </label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="contain-input">
            <label for="email">Email: </label>
            <input type="text" name="email" id="email" required>
        </div>
        <div class="contain-input">
            <label for="phone">Phone Number: </label>
            <input type="tel" name="phone" id="phone" required>
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
        <div id="contain-buttons" value="unactive">
            <button type="submit">Sign Up</button>
            <button type="reset">Clear</button>
        </div>
        <span>Already have an account? Try <a href="login.php">Login</a></span>
    </form>
</body>

</html>