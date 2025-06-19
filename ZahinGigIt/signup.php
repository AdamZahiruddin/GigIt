<?php
    require('inc/connect.php'); // Include the database connection file

    $nm = $_POST['name']; //$_POST is holding the data sent to the server using HTTP POST method, usually from an HTML form
    $phone = $_POST['phone'];
    $eml = $_POST['email'];
    $pass = $_POST['password'];
    $typeuser = $_POST['userType']; // Get the user type (employee or employer)

    // Hash password sebelum simpan ke database
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Check if it is employee or employer
    if($typeuser == "employee"){
        // Masukkan data ke dalam database
        $sql = "INSERT INTO employee (name, phone, email, password)
                VALUES ('$nm', '$phone', '$eml', '$hashed_password')";
        if($connect->query($sql) === TRUE){
            echo "New Record Created Successfully";
            echo "<meta http-equiv='refresh' content='1;URL=index.html'>";
            // Redirect to index.html after 1 seconds
        }
        else{
            echo "Error: " . $connect->error;
        }
    }
    else if($typeuser == "employer"){
        // Masukkan data ke dalam database
        $sql = "INSERT INTO employer (name, phone, email, password)
                VALUES ('$nm', '$phone', '$eml', '$hashed_password')";
        if($connect->query($sql) === TRUE){
            echo "New Record Created Successfully";
            echo "<meta http-equiv='refresh' content='1;URL=index.html'>";
            // Redirect to index.html after 1 seconds
        }
        else{
            echo "Error: " . $connect->error;
        }
    }

    $connect->close(); // Close the database connection
?>