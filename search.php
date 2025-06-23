<?php
    require("connect.php");

    if(isset($_GET['name']))
    {
        $keyword = strtolower(trim($_GET['name']));

        $sql = "SELECT * FROM post WHERE LOWER(title) LIKE '%$keyword'";

        $result = $conn->query($sql);

    }




?>