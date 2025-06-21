<?php
    include('inc/connect.php'); // Include the database connection file

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql_employee = "SELECT * FROM employee WHERE email='$email'";
    $result_employee = $connect->query($sql_employee);

    if($result_employee->num_rows > 0){ // Check if email exists in employee table
        // Hash the password
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        // Update in employee table
        $update_password_sql = "UPDATE employee SET password='$hash_password' WHERE email='$email'";
        if($connect->query($update_password_sql) === TRUE){ // If update is successful
            echo "Password updated successfully in employee table.";
            echo "<meta http-equiv='refresh' content='2;URL=index.php'>"; // Redirect to index.php after 1 second
        } else {
            echo "Error updating password in employee table: " . $connect->error;
        }
    }
    else{ // If not must in employer table
        $sql_employer = "SELECT * FROM employer WHERE email='$email'";
        $result_employer = $connect->query($sql_employer);
        if($result_employer->num_rows > 0){
            // Hash the password
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            // Update in employer table
            $update_password_sql = "UPDATE employer SET password='$hash_password' WHERE email='$email'";
            if($connect->query($update_password_sql) === TRUE){ // If update is successful
                echo "Password updated successfully in employee table.";
                echo "<meta http-equiv='refresh' content='2;URL=index.php'>"; // Redirect to index.php after 1 second
            } else {
                echo "Error updating password in employee table: " . $connect->error;
            }
        }
        else{ // If not found in both tables means the email doesn't exist
            echo "The email address you entered does not exist in our records.";
        }
    }

    $connect->close(); // Close the database connection
?>