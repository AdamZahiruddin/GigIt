<?php

session_start();
include 'connect.php';




$username = $_SESSION['email'] ?? 'guest';

$notificationsHTML = "";
$notificationError = false;

$notificationCount = 0;
if (!$notificationError && $result) {
    $notificationCount = $result->num_rows;
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


?>

<link rel="stylesheet" href="gigit UI/stylegig.css">
<style>
    .notif-dropdown {
        position: absolute;
        top: 40px;
        /* Adjust based on button height */
        right: 0;
        padding: 5px 20px;
        padding-bottom: 20px;
        width: 300px;
        min-height: 300px;
        max-height: 600px;
        overflow-y: auto;
        z-index: 1000;
        display: none;
        background: #f9f9f9;
        

    }

    .flex {
        display: flex;
        flex-direction: column;
    }

    .flex>* {
        width: 100%;
    }

    .notif-item {
        padding: 10px;
        border-bottom: 1px solid #eee;

        height: 100%;
        flex: 1;
    }

    .notiTitle {
        font-size: 20px;
        font-weight: bold;
        padding: 10px;
        margin: 0;
        border-bottom: 1px solid #ddd;
    }

    .notif-empty {
        text-align: center;
        padding: 20px;
        color: #999;
    }

    .notification-btn {
        position: relative;
        background: none;
        border: none;
        cursor: pointer;
    }
</style>
<button class="notification-btn">
    <img src="gigit UI/Images/bell.png" alt="Notifications" width="22" height="22">
    <span class="notification-badge"
        style="position: absolute; top: -4px; right: -4px; background: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px; display: none; <?= $notificationCount > 0 ? '' : 'display: none;' ?>">0</span>

</button>
<div id="notifDropdown" class="notif-dropdown container flex center-items">
    <p class="notiTitle">Notifications</p>
    <div class='notif-item center-items'>
        <?php


        try {
            $sql = "SELECT * FROM notifications WHERE toUser = ? ORDER BY notiTime DESC LIMIT 5";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result(); // use result from prepared statement
            $notificationCount = $result->num_rows;
            if ($notificationCount > 0) {
                while ($row = $result->fetch_assoc()) {
                    $notificationsHTML .= "<div class='notif-item'>";
                    $notificationsHTML .= "<p><strong>" . htmlspecialchars($row['notiTitle']) . "</strong></p>";
                    $notificationsHTML .= "<p>" . htmlspecialchars($row['notiContent']) . "</p>";
                    $notificationsHTML .= "<p class='time'>" . htmlspecialchars($row['notiTime']) . "</p>";
                    $notificationsHTML .= "</div>";
                }
            } else {
                $notificationsHTML = "<div class='notif-empty'>Wow such empty...</div>";
            }
        } catch (Exception $e) {
            $notificationsHTML = "<div class='notif-empty'>Notifications unavailable</div>";
        }
        ?>
        <?= $notificationsHTML ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Hide dropdown by default
        $('#notifDropdown').hide();

        $('.notification-btn').click(function (event) {
            event.stopPropagation();
            $('#notifDropdown').toggle();
        });

        $(document).click(function (event) {
            if (!$(event.target).closest('.notification-btn, #notifDropdown').length) {
                $('#notifDropdown').hide();
            }
        });

        // Update notification count
        var notificationCount = <?php echo $result->num_rows; ?>;
        if (notificationCount > 0) {
            $('.notification-badge').text(notificationCount).show();
        } else {
            $('.notification-badge').hide();
        }
    });
</script>