<?php
    include('../inc/connect.php'); // Include the database connection file

    $nm = $_POST['name']; //$_POST is holding the data sent to the server using HTTP POST method, usually from an HTML form
    $phone = $_POST['phone'];
    $eml = $_POST['email'];
    $pass = $_POST['password'];
    $typeuser = $_POST['userType']; // Get the user type (employee or employer)

    // Hash password sebelum simpan ke database
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Check if email already exists in employee table
    $check_employee_sql = "SELECT * FROM employee WHERE email='$eml'";
    $check_employee_result = $connect->query($check_employee_sql);
    $employee_exists = ($check_employee_result->num_rows > 0);

    // Check if email already exists in employer table
    $check_employer_sql = "SELECT * FROM employer WHERE email='$eml'";
    $check_employer_result = $connect->query($check_employer_sql);
    $employer_exists = ($check_employer_result->num_rows > 0);

    // If email exists in both tables, stop
    if ($employee_exists && $employer_exists) {
        echo "Email already exists as both employee and employer. Please use a different email.";
        echo "<meta http-equiv='refresh' content='1;URL=../index.php'>";
        exit;
    }

    // If trying to register as employee and email exists in employee table, stop
    if ($typeuser == "employee" && $employee_exists) {
        echo "Email already exists as employee. Please use a different email.";
        echo "<meta http-equiv='refresh' content='1;URL=../index.php'>";
        exit;
    }

    // If trying to register as employer and email exists in employer table, stop
    if ($typeuser == "employer" && $employer_exists) {
        echo "Email already exists as employer. Please use a different email.";
        echo "<meta http-equiv='refresh' content='1;URL=../index.php'>";
        exit;
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
        $sql = "INSERT INTO employee (employeeID, name, phone, email, password)
                VALUES ('$idEmployee','$nm', '$phone', '$eml', '$hashed_password')";
        if($connect->query($sql) === TRUE){
            echo "New Record Created Successfully";
            echo "<meta http-equiv='refresh' content='1;URL=../index.php'>";
            // Redirect to index.html after 1 seconds
        }
        else{
            echo "Error: " . $connect->error;
        }
    }
    else if($typeuser == "employer"){
        $idEmployer = "R" . generate_random_number(); // R for Employee
        // Masukkan data ke dalam database
        $sql = "INSERT INTO employer (employerID, name, phone, email, password)
                VALUES ('$idEmployer','$nm', '$phone', '$eml', '$hashed_password')";
        if($connect->query($sql) === TRUE){
            echo "New Record Created Successfully";
            echo "<meta http-equiv='refresh' content='1;URL=../index.php'>";
            // Redirect to index.html after 1 seconds
        }
        else{
            echo "Error: " . $connect->error;
        }
    }

    $connect->close(); // Close the database connection
?>