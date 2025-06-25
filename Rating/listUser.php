<?php 
    session_start();
    
    include("../inc/connect.php");

    // Get the logged-in employer's ID
    $employerID = $_SESSION['employerID'] ?? null;

    $employees = [];
    if ($employerID) {
        // Get employees with accepted applications for gigs posted by this employer
        $sql = "SELECT DISTINCT e.name, e.profile_pic, e.employeeID
                FROM application a
                JOIN post p ON a.postID = p.postID
                JOIN employee e ON a.employeeID = e.employeeID
                WHERE p.employerID = ? AND a.requestStatus = 'Accepted'";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $employerID);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GigIt</title>

    <link rel="stylesheet" href="listUser.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="lightmode">
    
    <?php include("../nav.php"); 
    include("../topbar.php");?>

    <div class="logo light">GigIt</div>
        <div class="mid-section">

            <div class="sprofileform">

                <h1>Previous Employees</h1>

                <div class="container">

                    <form action="profile.html" method="post">
                        <?php if (count($employees) > 0): ?>
                            <?php foreach ($employees as $emp): ?>
                                <div class="profile-pic-container">
                                    <img src="<?= htmlspecialchars($emp['profile_pic'] ?: 'https://cdn-icons-png.flaticon.com/512/149/149071.png') ?>" alt="Avatar" class="profile-pic">
                                    <label>
                                        <a href="rating.php?employeeID=<?= urlencode($emp['employeeID']) ?>">
                                            <?= htmlspecialchars($emp['name']) ?>
                                        </a>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No accepted employees yet.</p>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>