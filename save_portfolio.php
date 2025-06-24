<?php
$_SESSION['id'] = "E1";
session_start();

include("connect.php");

if (!isset($_SESSION['id'])) {
    die("Not logged in");
}

$userId = $_SESSION['id'];

if (isset($_FILES['portfolio_image']) && $_FILES['portfolio_image']['error'] == 0) {
    $uploadDir = 'uploads/portfolio/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // creates folder if it doesn't exist
    }

    $filePath = $uploadDir . basename($_FILES['portfolio_image']['name']);
    move_uploaded_file($_FILES['portfolio_image']['tmp_name'], $filePath);
    $pfID = 'P' . uniqid();

    $stmt = $conn->prepare("INSERT INTO portfolio (pfID, employeeID, pfPicture, pfDesc, pfTitle) VALUES (?, ?, ?,? , ?)");
    $stmt->bind_param("sssss", $pfID, $userId, $filePath);
    $stmt->execute();
}

header("Location: profile.php?id=$userId");