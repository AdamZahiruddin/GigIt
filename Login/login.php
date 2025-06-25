<?php
    // Initialize session
    session_start();
    include("../inc/connect.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usernameOrEmail = $_POST['username'];
        $input_password = $_POST['password'];

        // Check employer table
        $sqlEmp = "SELECT * FROM employer WHERE name = '$usernameOrEmail' OR email = '$usernameOrEmail'";
        $resultEmp = $connect->query($sqlEmp);
        $employer = ($resultEmp->num_rows == 1) ? $resultEmp->fetch_assoc() : null;

        // Check employee table
        $sqlEe = "SELECT * FROM employee WHERE name = '$usernameOrEmail' OR email = '$usernameOrEmail'";
        $resultEe = $connect->query($sqlEe);
        $employee = ($resultEe->num_rows == 1) ? $resultEe->fetch_assoc() : null;

        // If found in both, ask for role
        if (
            $employer && $employee &&
            password_verify($input_password, $employer['password']) &&
            password_verify($input_password, $employee['password'])
        ) {
            $_SESSION['login_candidate'] = [
                'employer' => $employer,
                'employee' => $employee,
                'password' => $input_password
            ];
            header("Location: chooseRole.php");
            exit;
        }

        // Employer login
        if ($employer && password_verify($input_password, $employer['password'])) {
            $_SESSION['username'] = $employer['name'];
            $_SESSION['employerID'] = $employer['employerID'];
            $loggedUser = $_SESSION['employerID'];
            header("Location: ../GigPosts/managePosts.php");
            exit;
        }

        // Employee login
        if ($employee && password_verify($input_password, $employee['password'])) {
            $_SESSION['username'] = $employee['name'];
            $_SESSION['employeeID'] = $employee['employeeID'];
            $loggedUser = $_SESSION['employeeID'];
            header("Location: ../homePage.PHP");
            exit;
        }

        // Login failed
        echo "Login Failed: Incorrect credentials.";
        session_unset();
        echo "<meta http-equiv='refresh' content='2;URL=../index.php'>";
    }
    $connect->close(); // Recommend to close the connection after use
?>