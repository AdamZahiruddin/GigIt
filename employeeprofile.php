<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GigIt Profile</title>

    <link rel="stylesheet" href="gigit UI/stylegig.css">
    <link rel="stylesheet" href="gigit UI/profile.css">
</head>

<body class="lightmode">
    <div class="logo light">GigIt</div>
    <header>



        <nav class="sidebar">

            <a href="home.php">Home</a>
            <a href="profile.php">Profile</a>
            <a href="signin.html">Sign In</a>
            <a href="index.html">Sign Up</a>

        </nav>
    </header>
    <div class="top-bar">


        <div class="search-notify-container">
            <form class="search-bar" action="search.html" method="get">
                <input type="text" placeholder="Search..." id="searchinput" name="search"
                    style="padding: 6px 10px; border-radius: 4px; border: 1px solid #ccc;">
                <button id="searchsubmit" type="submit"
                    style="background: none; border: none; cursor: pointer; margin-left: 4px;">
                    <img src="https://cdn-icons-png.flaticon.com/512/622/622669.png" alt="Search" width="20"
                        height="20">
                </button>
            </form>
            <div>

                <?php

                include("notification.php");

                ?>
            </div>

        </div>

        <div class="mid-section">




            <div class="sprofileform">
                <?php
                session_start();
                include("connect.php");

                $userId = isset($_GET['id']) ? intval($_GET['id']) : 1; // Default to 1
                
                $sql = "SELECT * FROM user_profiles WHERE id = $userId";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $name = $row['name'];
                    $email = $row['email'];
                    $phone = $row['phone'];
                    $age = $row['age'];
                    $location = $row['location'];
                    $bio = $row['bio'];
                    // echo into HTML here
                } else {
                    echo "User not found.";
                }
                ?>

                <h1>Profile</h1>
                <div class="profile-pic-container">
                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Default Avatar"
                        class="profile-pic">
                </div>
                <div class="container">
                    <p class="subtext" style="text-align: left;">Here are your profile details:</p>

                    <div class="contain-input">
                        <label>Name</label>
                        <p id="name"><?php echo $name; ?></p>
                    </div>
                    <div class="contain-input">
                        <label>Email</label>
                        <p id="email"><?php echo $email ?></p>
                    </div>
                    <div class="contain-input">
                        <label>Phone Number</label>
                        <p id="phone"><?php echo $phone ?></p>
                    </div>
                    <div class="contain-input age-view">
                        <label>Age</label>
                        <p id="age"><?php echo $age ?></p>
                    </div>
                    <div class="contain-input">
                        <label>Location</label>
                        <p id="location"><?php echo $location ?></p>
                    </div>
                    <div class="contain-input">
                        <label>Bio</label>
                        <p id="bio"><?php echo $bio ?></p>
                    </div>
                </div>
            </div>
            <article class="container portfolio">

                <div class="portfolio-header">
                    <h2 style="margin: 10px 0;">Portfolio</h2>
                    <p class="subtext">Showcase your work or projects here</p>
                </div>
                <div class="portfolio-items">
                    <img src="https://cdn-icons-png.flaticon.com/512/149/149022.png" alt="Default Portfolio Item"
                        class="portfolio-item">
                    <p class="subtext bold blue">No portfolio items yet. Add some to showcase your work!</p>
                </div>
                <div class="portfolio-actions">
                    <button class="add-portfolio-btn">Add Portfolio Item</button>

                </div>
            </article>
        </div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                // Make all images non-draggable
                $('img').attr('draggable', false);

                // Prevent pointer events and cursor change on images
                $('img').css({
                    'pointer-events': 'none',
                    'cursor': 'default'
                });

                $('#upload-photo').on('change', function (event) {
                    const file = event.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            $('.profile-pic').attr('src', e.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });

            });

        </script>
</body>

</html>