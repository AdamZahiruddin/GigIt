<?php

echo "<pre>";
print_r($_FILES);
echo "</pre>";
session_start();
include "nav.php";
include "connect.php";

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
if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
    $uploadDir = 'uploads/';
     if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
        chmod($uploadDir, 0777);
    }
    $originalName = basename($_FILES['profile_pic']['name']);
    $newFileName = uniqid('img_') . '_' . $originalName;
    // Create upload directory if it doesn't exist
   
    $uploadPath = "{$uploadDir}{$newFileName}";

    if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $uploadPath)) {
        $picture_sql = ", profile_pic = '{$uploadPath}'";
    } else {
        echo "<p style= 'text-align:center;color:red'>Image upload failed.</p>";
    }
}else{
    echo "file size too big";
    exit();
}

// Safely build SQL string
$sql = "UPDATE employee SET 
    name = '{$nm}',
    email = '{$eml}',
    phone = '{$phone}', 
    age = '{$age}',
    location = '{$location}',
    bio = '{$bio}'{$picture_sql}
    WHERE id = '{$id}'";

if ($conn->query($sql) === TRUE) {
    echo "<p style='text-align:center;'>Profile updated successfully.</p>";
    if (!empty($uploadPath)) {
        echo "<p style='text-align:center;'><img src='$uploadPath' width='150'></p>";
    }

} else {
    echo "<p style='text-align:center;color:red'>Update failed: {$conn->error}</p>";
    exit();
}

$conn->close();
include "footer.php";