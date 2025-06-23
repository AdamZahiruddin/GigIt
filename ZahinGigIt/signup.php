<?php
    include('inc/connect.php'); // Include the database connection file

    $nm = $_POST['name']; //$_POST is holding the data sent to the server using HTTP POST method, usually from an HTML form
    $phone = $_POST['phone'];
    $eml = $_POST['email'];
    $pass = $_POST['password'];
    $typeuser = $_POST['userType']; // Get the user type (employee or employer)

    // Hash password sebelum simpan ke database
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Check if email already exists
    $check_email_sql = "SELECT * FROM employee WHERE email='$eml' UNION SELECT * FROM employer WHERE email='$eml'";
    $check_email_result = $connect->query($check_email_sql);
    if ($check_email_result->num_rows > 0) {
        echo "Email already exists. Please use a different email.";
        echo "<meta http-equiv='refresh' content='1;URL=index.php'>";
        exit; // Stop further execution if email exists
    }

    // ID Generate Random
    function generate_random_number($length = 6) {
        $min = 0; // Minimum value for a 6-digit number
        $max = 999999; // Maximum value for a 6-digit number
        $number = rand($min, $max);
        // Added to the left string with 0 if the number is less than 6 digits
        // str_pad(number, length, pad_string, pad_type)
        return str_pad($number, $length, '0', STR_PAD_LEFT);
    }   

    // Check if it is employee or employer
    if($typeuser == "employee"){
        $idEmployee = "E" . generate_random_number(); // E for Employee
        // Masukkan data ke dalam database
        $sql = "INSERT INTO employee (id, name, phone, email, password)
                VALUES ('$idEmployee','$nm', '$phone', '$eml', '$hashed_password')";
        if($connect->query($sql) === TRUE){
            echo "New Record Created Successfully";
            echo "<meta http-equiv='refresh' content='1;URL=index.php'>";
            // Redirect to index.html after 1 seconds
        }
        else{
            echo "Error: " . $connect->error;
        }
    }
    else if($typeuser == "employer"){
        $idEmployer = "R" . generate_random_number(); // R for Employee
        // Masukkan data ke dalam database
        $sql = "INSERT INTO employer (id, name, phone, email, password)
                VALUES ('$idEmployer','$nm', '$phone', '$eml', '$hashed_password')";
        if($connect->query($sql) === TRUE){
            echo "New Record Created Successfully";
            echo "<meta http-equiv='refresh' content='1;URL=index.php'>";
            // Redirect to index.html after 1 seconds
        }
        else{
            echo "Error: " . $connect->error;
        }
    }

    $connect->close(); // Close the database connection
?>