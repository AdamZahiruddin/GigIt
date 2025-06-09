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
                <label for="contact">Contact: </label>
                <input type="text" name="contact" id="contact" required>
            </div>
        </div>
        <div id="contain-btn-posts">
            <button type="submit" id="btn-create" value="unactive">Create Post</button>
            <button type="button" id="btn-next">Next</button>
        </div>
    </form>
</body>

<script src="./script.js" type="text/javaScript"></script>
</html>