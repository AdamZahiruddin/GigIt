<!DOCTYPE html>
<html lang="en">
<?php

flush(); ?>

<head>
    <meta charset="UTF-8">
    <title>GigIt Profile</title>

    <link rel="stylesheet" href="gigit UI/stylegig.css">
    <link rel="stylesheet" href="gigit UI/profile.css">
</head>

<body class="lightmode">

    <header>
        <?php include("nav.php"); ?>
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

                //include("notification.php");
                
                ?>
            </div>

        </div>

        <div class="mid-section">




            <div class="sprofileform">
                <?php
                session_start();
                include("connect.php");

                // Get user ID from URL or session
                if (isset($_GET['id'])) {
                    $userId = $_GET['id'];
                } elseif (isset($_SESSION['user_id'])) {
                    $userId = $_SESSION['user_id'];
                } else {
                    echo "No user specified.";
                    exit;
                }

                // Check user type from ID prefix
                $prefix = strtoupper(substr($userId, 0, 1)); // Get first character
                
                if ($prefix === 'E') {
                    $table = 'employee_profiles';
                } elseif ($prefix === 'R') {
                    $table = 'employer_profiles';
                } else {
                    echo "Invalid user ID format.";
                    exit;
                }

                // Fetch profile from the correct table
                $stmt = $conn->prepare("SELECT * FROM $table WHERE id = ?");
                $stmt->bind_param("s", $userId);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    echo "<h2>" . ($prefix === 'E' ? "Employee" : "Employer") . " Profile</h2>";
                    echo "<p>Name: " . $row['name'] . "</p>";
                    echo "<p>Email: " . $row['email'] . "</p>";
                    echo "<p>Phone: " . $row['phone'] . "</p>";
                    // Add more fields as needed
                } else {
                    echo "User profile not found.";
                }

                $stmt->close();
                ?>

                <h1>Profile</h1>
                <div class="profile-pic-container">
                    <?php
                    $defaultAvatarPath = 'https://cdn-icons-png.flaticon.com/512/149/149071.png'; // default profile pic
                    
                    if (!empty($row['profile_pic']) && file_exists($row['profile_pic'])) {
                        $picturePath = $row['profile_pic'];
                    } else {
                        $picturePath = $defaultAvatarPath;
                    }
                    ?>
                    <img class="profile-pic imgcenter" src="<?php echo htmlspecialchars($picturePath); ?>"
                        alt="Profile Picture">
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
                        <p style="text-align: center;" id="age"><?php echo $age ?></p>
                    </div>
                    <div class="contain-input">
                        <label>Location</label>
                        <p id="location"><?php echo $location ?></p>
                    </div>
                    <div class="contain-input">
                        <label>Bio</label>
                        <p id="bio"><?php echo $bio ?></p>
                    </div>
                    <?php
                    $_SESSION['id'] = 1; // Simulating a logged-in user for demonstration
                    // Check if the user is logged in and matches the profile being viewed
                    if (isset($_SESSION['id']) && $_SESSION['id'] == $userId) {
                        echo '<div  id="contain-buttons">';
                        echo '<button class="edit-profile-btn" onclick="window.location.href=\'profileform.php\'">Edit Profile</button>';
                        echo '</div>';
                    }
                    ?>

                </div>
            </div>
            <!-- <article class="container portfolio">

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
            </article> -->
        </div>

        <?php include("footer.php"); ?>


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