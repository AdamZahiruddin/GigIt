<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GigIt</title>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
    <link rel="stylesheet" href="./style.css">
=======
    <link rel="stylesheet" href="./styling/style2.css">
>>>>>>> Stashed changes
=======
    <link rel="stylesheet" href="./styling/style2.css">
>>>>>>> Stashed changes
</head>

<?php
    require("connect.php");
    session_start();
<<<<<<< Updated upstream
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashpassword = password_hash($password, PASSWORD_DEFAULT);

        $result = $conn->query("SELECT * FROM admin WHERE name = $username");
        if($result->num_rows == 0){
            $sql = "INSERT INTO admin (name, password) VALUES ('$username', '$hashpassword')";
=======
    if(isset($_POST['email'])){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashpassword = password_hash($password, PASSWORD_DEFAULT);

        $result = $conn->query("SELECT * FROM admin WHERE email = '$email'");
        if($result->num_rows == 0){
            $idAdmin = "A" . generate_random_number();
            $sql = "INSERT INTO admin (adminID, name, phone, email, password) VALUES ('$idAdmin', '$name', '$phone', '$email', '$hashpassword')";
>>>>>>> Stashed changes
            if($conn->query($sql)){
                header("Location: ./admin-login.php");
            }          
        }
        else{
            echo "User admin already exist";
        }
    }
<<<<<<< Updated upstream
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
=======

    function generate_random_number($length = 6) {
        $min = 0; // Minimum value for a 6-digit number
        $max = 999999; // Maximum value for a 6-digit number
        $number = rand($min, $max);
        // Added to the left string with 0 if the number is less than 6 digits
        // str_pad(number, length, pad_string, pad_type)
        return str_pad($number, $length, '0', STR_PAD_LEFT);
    }   
?>

<body>
    <header class="logo">
        GigIt
    </header>
    <section class="mid-section">
        <form class="container" action="./admin-add.php" method="post">

            <h2 style="margin-bottom: auto; text-align: left;">Create Admin Account</h2>
            
            <div class="contain-input">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div class="contain-input">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" required>
            </div>

            <div class="contain-input">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required>
            </div>

            <div class="contain-input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div id="contain-buttons">
                <button type="submit">Create</button>
                <button type="reset">Clear</button>
            </div>

            <span class="subtext">Already have an account? Try <a href="./admin-login.php">Login</a></span>
        </form>
    </section>

>>>>>>> Stashed changes
</body>
</html>