<?php
session_start();
include("../inc/connect.php");
include("../topbar.php");

$employeeID = $_GET['employeeID'] ?? null;
$emp = null;
if ($employeeID) {
    $stmt = $connect->prepare("SELECT name, profile_pic FROM employee WHERE employeeID = ?");
    $stmt->bind_param("s", $employeeID);
    $stmt->execute();
    $stmt->bind_result($name, $profile_pic);
    if ($stmt->fetch()) {
        $emp = ['name' => $name, 'profile_pic' => $profile_pic];
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GigIt Profile</title>
    <link rel="stylesheet" href="rating.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="lightmode">

    <div class="logo light">GigIt</div>
    <header>
        <?php include("../nav.php"); ?>
    </header>

    <div class="mid-section">

        <div class="sprofileform">

            <h1>Rating</h1>
                <div class="container">
                    <form action="feedback.php" method="POST">
                        <input type="hidden" name="employeeID" value="<?= htmlspecialchars($employeeID) ?>">
                        <input type="hidden" name="employerID" value="<?= htmlspecialchars($_SESSION['employerID'] ?? '') ?>">
                        <div class="profile-pic-container">
                            <img src="<?= htmlspecialchars($emp['profile_pic'] ?: 'https://cdn-icons-png.flaticon.com/512/149/149071.png') ?>" alt="Avatar" class="profile-pic">
                        </div>

                        <label class="profile-name"><?= htmlspecialchars($emp['name'] ?? 'Name') ?></label>
                        <!-- Make rating by star -->
                        <div class="rating-css">

                            <div class="star-icon">
                                <input type = "radio" name="rating" id="rating1" value="1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type = "radio" name="rating" id="rating2" value="2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type = "radio" name="rating" id="rating3" value="3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type = "radio" name="rating" id="rating4" value="4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type = "radio" name="rating" id="rating5" value="5">
                                <label for="rating5" class="fa fa-star"></label>
                            </div>
                        </div>

                        <div id="contain-buttons">
                            <!-- window.location.href = 'changes current page to other page'-->
                            <button type="button" onclick="window.location.href='listUser.php'">Cancel</button>
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</body>
</html>