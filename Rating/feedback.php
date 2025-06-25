<?php
session_start();
include("../topbar.php");
include("../inc/connect.php");

$success = false;
$fail = false; // Add this
$details = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['submit']) || isset($_POST['skip']))) {
    $employeeID = $_POST['employeeID'] ?? '';
    $employerID = $_POST['employerID'] ?? ($_SESSION['employerID'] ?? '');
    $rateStar = $_POST['rating'] ?? '';
    $feedback = trim($_POST['feedback'] ?? '');

    if ($employeeID && $employerID && $rateStar) {
        $stmt = $connect->prepare("INSERT INTO rating (rateStar, feedback, toEmployee, fromEmployer) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $rateStar, $feedback, $employeeID, $employerID);
        $success = $stmt->execute();
        $stmt->close();

        $details = [
            'rateStar' => $rateStar,
            'feedback' => $feedback,
            'toEmployee' => $employeeID,
            'fromEmployer' => $employerID
        ];
        if (!$success) $fail = true;
    } else {
        $fail = true; // Set fail if required fields are missing
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GigIt Profile</title>

    <link rel="stylesheet" href="feedback.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="lightmode">
    <div class="logo light">GigIt</div>

    <div class="mid-section">
        <div class="sprofileform">
            <h1>Rating</h1>
            <div class="container">
                <?php if ($success): ?>
                    <h2 style="text-align: center; color: green;">Success! Rating submitted.</h2>
                    <p><strong>Stars:</strong> <?= htmlspecialchars($details['rateStar']) ?></p>
                    <p><strong>Feedback:</strong> <?= nl2br(htmlspecialchars($details['feedback'])) ?></p>
                    <p><strong>From Employer:</strong> <?= htmlspecialchars($details['fromEmployer']) ?></p>
                    <p><strong>To Employee:</strong> <?= htmlspecialchars($details['toEmployee']) ?></p>
                    <meta http-equiv='refresh' content='1;URL=listUser.php'>
                <?php else: ?>
                    <h2 style="text-align: center;">Give Feedback?</h2>
                    <?php if ($fail): ?>
                        <p style="color: red; text-align: center;">Failed to submit. Please fill in all required fields especially if you not click star.</p>
                        <meta http-equiv='refresh' content='2;URL=listUser.php'>
                    <?php endif; ?>
                    <form action="" method="POST">
                        <input type="hidden" name="employeeID" value="<?= htmlspecialchars($_POST['employeeID'] ?? '') ?>">
                        <input type="hidden" name="employerID" value="<?= htmlspecialchars($_POST['employerID'] ?? ($_SESSION['employerID'] ?? '')) ?>">
                        <input type="hidden" name="rating" value="<?= htmlspecialchars($_POST['rating'] ?? '') ?>">
                        <textarea name="feedback" rows="5" cols="60" placeholder="Write your feedback here..."></textarea>
                        <br>
                        <div id="contain-buttons">
                            <button type="submit" name="submit" value="1">Submit</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
</html>