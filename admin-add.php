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
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashpassword = password_hash($password, PASSWORD_DEFAULT);

        $result = $conn->query("SELECT * FROM admin WHERE email = '$email'");
        if($result->num_rows == 0){
            $idAdmin = "A" . generate_random_number();
            $sql = "INSERT INTO admin (adminID, name, phone, email, password) VALUES ('$idAdmin', '$name', '$phone', '$email', '$hashpassword')";
            if($conn->query($sql)){
                header("Location: ./admin-login.php");
            }          
        }
        else{
            echo "User admin already exist";
        }
    }

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

</body>
</html>