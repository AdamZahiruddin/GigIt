<?php


session_start();
include "../nav.php";
include "../inc/connect.php";

$nm = $_POST['name'];
$eml = $_POST['email'];
$phone = $_POST['phone'];
$age = $_POST['age'];
$location = $_POST['location'];
$bio = $_POST['bio'];

$id = $_SESSION['employerID'] ?? $_SESSION['employeeID'];

$uploadPath = "";
$picture_sql = "";


$prefix = strtoupper(substr($id, 0, 1)); // Get first character

if ($prefix === 'E') {
    $table = 'employee';
    $idtype = 'employeeID';
} elseif ($prefix === 'R') {
    $table = 'employer';
    $idtype = 'employerID';
} else {
    echo "Invalid user ID format.";
    exit;
}
// Handle image upload
if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
    $uploadDir = '../uploads/profilepic/';
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
} 

// Safely build SQL string
$sql = "UPDATE $table SET 
    name = '{$nm}',
    email = '{$eml}',
    phone = '{$phone}', 
    age = '{$age}',
    location = '{$location}',
    bio = '{$bio}'{$picture_sql}
    WHERE $idtype = '{$id}'";

if ($connect->query($sql) === TRUE) {
    echo "<script>
        alert('Profile updated successfully.');
        window.location.href = 'profile.php';
    </script>";
    exit();
} else {
    echo "<script>
        alert('Update failed: {$connect->error}');
        window.location.href = 'Profileform.php';
    </script>";
    exit();
}

$connect->close();
include "../footer.php";

?>