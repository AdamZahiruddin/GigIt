<?php
    $servername = "localhost";  // Sets database server address (usually "localhost" for local development)
    $username = "root";         // Sets database username (default is XAMPP is "root")
    $password = "";         // Sets database password ("1234" is used)
    $dbname = "gigit";          // Sets name of the database to connect to ("gigit")

    // Create connection
    $connect = new mysqli($servername, $username, $password, $dbname);
    // Create a new MYSQLI connection object and tries to connect to the database

    // Check connection
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error); 
        // Checks if the connection failed so stops the script and print error
    }
    // If Successful
    //echo "Connected Succesfully to the database<br>"; // Use <br> cant use \n because this is HTML output
?>