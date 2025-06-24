<?php
session_start();
include("connect.php");

if (!isset($_SESSION['id'])) {
    die("Not logged in");
}

$userId = $_SESSION['id'];

if (isset($_FILES['portfolio_image']) && $_FILES['portfolio_image']['error'] == 0) {
    $uploadDir = 'uploads/';
    $filePath = $uploadDir . basename($_FILES['portfolio_image']['name']);
    move_uploaded_file($_FILES['portfolio_image']['tmp_name'], $filePath);

    $stmt = $conn->prepare("INSERT INTO portfolio (user_id, image_url) VALUES (?, ?)");
    $stmt->bind_param("is", $userId, $filePath);
    $stmt->execute();
}

header("Location: profile.php?id=$userId");