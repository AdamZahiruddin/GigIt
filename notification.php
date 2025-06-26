<?php

//session_start();
include 'inc/connect.php';




$username = $_SESSION['employeeID'] ?? $_SESSION['employerID'];



mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


?>


<style>
    .notif-dropdown {
        position: absolute;
        top: 40px;
        right: 0;
        width: 320px;
        min-height: 120px;
        max-height: 420px;
        z-index: 1000;
        display: none;
        background: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.12);
        padding: 0;
        overflow: hidden; /* Hide scrollbars on the dropdown itself */
    }

    .notif-list {
        max-height: 350px; /* Adjust as needed */
        overflow-y: auto;
        padding: 0 20px 20px 20px;
        margin: 0;
    }

    .flex {
        display: flex;
        flex-direction: column;
    }

    .notif-item {
        padding: 12px 0;
        border-bottom: 1px solid #eee;
        background: #fff;
    }

    .notiTitle {
        font-size: 20px;
        font-weight: bold;
        padding: 16px 20px 8px 20px;
        margin: 0;
        border-bottom: 1px solid #ddd;
        background: #f3f3f3;
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
    <!-- Emoji -->
    <span style="font-size:22px;">🔔</span>

    
    <span class="notification-badge"
        style="position: absolute; top: -4px; right: -4px; background: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px; display: none; <?= $notificationCount > 0 ? '' : 'display: none;' ?>">0</span>
</button>
<div id="notifDropdown" class="notif-dropdown container flex center-items">
    <p class="notiTitle">Notifications</p>
    <div class="notif-list">
        <?php


        try {
            $notificationsHTML = "";
            $sql = "SELECT * FROM notifications WHERE toUser = ? ORDER BY notiTime DESC LIMIT 5";
            $stmt = $connect->prepare($sql);
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