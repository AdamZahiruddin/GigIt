<?php
session_start();
if (!isset($_SESSION['login_candidate'])) {
    header("Location: index.php");
    exit;
}
$candidate = $_SESSION['login_candidate'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['role'])) {
    $role = $_POST['role'];
    $password = $candidate['password'];

    if ($role == 'employer') {
        if (password_verify($password, $candidate['employer']['password'])) {
            $_SESSION['username'] = $candidate['employer']['name'];
            $_SESSION['employerID'] = $candidate['employer']['employerID'];
            unset($_SESSION['login_candidate']);
            header("Location: ../GigPosts/managePosts.php");
            exit;
        } else {
            $error = "Incorrect password for employer.";
        }
    } elseif ($role == 'employee') {
        if (password_verify($password, $candidate['employee']['password'])) {
            $_SESSION['username'] = $candidate['employee']['name'];
            $_SESSION['employeeID'] = $candidate['employee']['employeeID'];
            unset($_SESSION['login_candidate']);
            header("Location: ../homePage.php");
            exit;
        } else {
            $error = "Incorrect password for employee.";
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Choose Role</title>
    <link rel="stylesheet" href="./styling/style.css">
    <link rel="stylesheet" href="./styling/stylegig.css">

    <style>
        .container
        {
            background: #fff;
            padding: 32px 40px;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.08);
            text-align: center;
        }
        body{
            margin-top: 390px;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
         <h2>Choose which account to log in as:</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post">
            <button type="submit" name="role" value="employer">Employer</button>
            <button type="submit" name="role" value="employee">Employee</button>
        </form>

    </div>
   
</body>
</html>