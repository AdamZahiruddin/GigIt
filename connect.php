<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gigit";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){
        die("Connection to database failed: " . $conn->connect_error);
    }
?>