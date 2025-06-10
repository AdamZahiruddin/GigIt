<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" type="text/javaScript" ></script>
    <title>GigIt</title>
</head>
<body>
    <?php
        include('nav.php');
        require('connect.php');

        $email = $_SESSION['email'];
        $result = $conn->query("SELECT * FROM employer WHERE email = '$email'");
        $user = $result->fetch_assoc();
        
        if(isset($_POST['contactOwner'])){
            $title = $_POST['title'];
            $desc = $_POST['gigDesc'];
            $salary = $_POST['salary'];
            $location = $_POST['location'];
            $date = $_POST['date'];
            $contact = $_POST['contactOwner'];
            $userid = $user['EmployerID'];
            $postType = $_POST['postType'];
            $time = new DateTime("now", new DateTimeZone('Asia/Kuala_Lumpur'));
            $timeFormatted = $time->format('H:i:s');

            $sql = "INSERT INTO post (EmployerID, title, description, date, time, contactOwner, location, salary, type, status) VALUES ('$userid', '$title', '$desc', '$date', '$timeFormatted', '$contact', '$location', '$salary', '$postType', 'Ongoing')";
            
            if($conn->query($sql)){
                header("Location: home.php");
            }
            else{
                echo 'Post create failed!';
            }
        }
    ?>
    <form action="create.php" method="post" id="form-create">
        <h2>Create Post</h2>
        <div id="create-part1" value="active">
            <div class="contain-input">
                <label for="title">Gig Title: </label>
                <input type="text" name="title" id="title" required>
            </div>
            <div class="contain-input">
                <label for="gigDesc">Gig Description: </label>
                <input type="text" name="gigDesc" id="gigDesc" required>
            </div>
        </div>
        <div id="create-part2" value="unactive">
            <div class="contain-input">
                <label for="salary">Salary: </label>
                <input type="text" name="salary" id="salary" required>
            </div>
            <div class="contain-input">
                <label for="location">Location: </label>
                <input type="text" name="location" id="location" required>
            </div>
            <div class="contain-input">
                <label for="date">Date: </label>
                <input type="date" name="date" id="date" required>
            </div>
            <div class="contain-input">
                <label for="contactOwner">Contact: </label>
                <input type="tel" name="contactOwner" id="contactOwner" required>
            </div>
            <div class="contain-input">
                <label for="postType">Type: </label>
                <input type="radio" name="postType" id="postPerson" value="Personal" checked>
                Personal
                <input type="radio" name="postType" id="postCommunity" value="Community">
                Community
            </div>
        </div>
        <div id="contain-btn-posts">
            <button type="button" id="btn-next">Next</button>
            <button type="submit" id="btn-create" value="unactive">Create Post</button>
        </div>
    </form>
</body>

<script src="./script.js" type="text/javaScript"></script>
</html>