<?php 
    session_start();
    $_SESSION = array();
    session_destroy();
    header("refresh:3; url=index.php");
    echo "Logout Successful! Redirecting...";
?>