<?php
    // Initialize session
    session_start();
    include("inc/connect.php");
    // Ambil input dari POST jika belum di set
    if(!isset($_SESSION['username']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
    }

    // Cek ada username dan password dalam session
    if(isset($_SESSION['username'], $_SESSION['password'])){
        $username = $_SESSION['username'];
        $input_password = $_SESSION['password'];

        // Cari pengguna based on username
        $sql = "SELECT * FROM employee WHERE name = '$username' UNION
                SELECT * FROM employer WHERE name = '$username'";
        $result = $connect->query($sql);
        
        if($result->num_rows == 1){
            $user = $result->fetch_assoc(); // Fetch the data row
            // Guna password_verify untuk semak kata laluan
            if(password_verify($input_password, $user['password'])){
                include("listUser.html"); // MUST CHANGE THIS TO MAIN PAGE !!!!!
            }
            else{
                echo "Login Failed: Incorrect password.";
                session_unset();
                echo "<meta http-equiv='refresh' content='2;URL=index.php'>";
            }
        }
        else{
            echo "Login Failed: Username not found.";
            session_unset();
            echo "<meta http-equiv='refresh' content='2;URL=index.php'>";
        }
    }
    $connect->close(); // Recommend to close the connection after use
?>