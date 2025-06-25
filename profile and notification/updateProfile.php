<?php
session_start();
include("nav.php");
include("connect.php");

$nm = $_POST['name'];
$eml = $_POST['email'];
$phone = $_POST['phone'];
$age= $_POST['age'];
$location = $_POST['location'];
$bio = $_POST['bio'];

$id = $_SESSION['id'] ?? 1; // Fallback to 1 if not set

$uploadPath = "";
$picture_sql = "";

// Handle image upload
if (isset($_FILES['profilepic']) && $_FILES['profilepic']['error'] === 0) {
    $uploadDir = 'uploads/';
    $originalName = basename($_FILES['profilepic']['name']);
    $newFileName = uniqid('img_') . '_' . $originalName;
    $uploadPath = $uploadDir . $newFileName;

    if (move_uploaded_file($_FILES['profilepic']['tmp_name'], $uploadPath)) {
        $picture_sql = " profile_pic = '$uploadPath'";
    } else {
        echo "<p style= 'text-align:center;color:red'>Image upload failed.</p>";
    }
}

// Safely build SQL string
$sql = "UPDATE user_profiles SET 
    name = '$nm',
    email = '$eml',
    phone = '$phone', 
    age = '$age',
    location = '$location',
    bio = '$bio'" . $picture_sql . "
    WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "<p style='text-align:center;'>Profile updated successfully.</p>";
    if (!empty($uploadPath)) {
        echo "<p style='text-align:center;'><img src='$uploadPath' width='150'></p>";
    }

} else {
    echo "<p style='text-align:center;color:red'>Update failed: " . $conn->error . "</p>";
    exit();
}

$conn->close();
include("footer.php");
?>
