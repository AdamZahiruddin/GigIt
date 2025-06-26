<?php
    //Initialize session
    session_start();
    if(isset($_SESSION['username'])) {
        // Destroy the whole session
        $_SESSION = array(); // Clear all session variables
        session_destroy();
        echo "<meta http-equiv='refresh' content='0;URL=../index.php'>"; // Redirect to index page
    }
?>