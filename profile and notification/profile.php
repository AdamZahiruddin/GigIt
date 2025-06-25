<!DOCTYPE html>
<html lang="en">
<?php

flush(); ?>

<head>
    <meta charset="UTF-8">
    <title>GigIt Profile</title>

    <link rel="stylesheet" href="gigit UI/stylegig.css">
    <link rel="stylesheet" href="gigit UI/profile.css">
    <style>
        .emptydetails {
            color: grey;
            font-family: 'Courier New', Courier, monospace;
            font-style: italic;
            text-align: left;
        }
    </style>
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

                include("notification.php");

                ?>
            </div>

        </div>

        <div class="mid-section">




            <div class="sprofileform">
                <?php
                session_start();
                include("connect.php");

                // Use 'E1' as the test user ID
                $userId = "E1";
                $_SESSION['id']= $userId;

                // Check user type from ID prefix
                $prefix = strtoupper(substr($userId, 0, 1)); // Get first character
                
                if ($prefix === 'E') {
                    $table = 'employee';
                } elseif ($prefix === 'R') {
                    $table = 'employers';
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

                    $name = isset($row['name']) ? $row['name'] : '';
                    $email = isset($row['email']) ? $row['email'] : '';
                    $phone = isset($row['phone']) ? $row['phone'] : '';
                    $age = isset($row['age']) ? $row['age'] : '';
                    $location = isset($row['location']) ? $row['location'] : '';
                    $bio = isset($row['bio']) ? $row['bio'] : '';

                } else {
                    echo "User profile not found.";
                    exit;
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

                    <p id="name"><?php echo "<h1>" . ucwords($name) . "</h1>"; ?></p>
                </div>
                <div class="prfcontainer">
                    <p class="subtext" style="text-align: left;">Here are your profile details:</p>
                    <table class="profile-input">
                        <tr>
                            <td><label>Name</label></td>
                            <td>
                                <p id="name"><?php echo $name; ?></p>
                            </td>
                        </tr>
                        <tr class="age-view">
                            <td><label>Age</label></td>
                            <td>
                                <p style="text-align: center;" id="age"><?php echo $age ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Email</label></td>
                            <td>
                                <p id="email"><?php echo $email ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Phone Number</label></td>
                            <td>
                                <p id="phone"><?php echo $phone ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Location</label></td>
                            <td>
                                <p id="location">
                                    <?php echo !empty($location) ? $location : '<span class="emptydetails">No location provided</span>'; ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Bio</label></td>
                            <td>
                                <p id="bio">
                                    <?php echo !empty($bio) ? $bio : '<span class="emptydetails">No bio provided</span>' ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                    <!-- <div  >
                        <label>Name</label>
                        <p id="name"><?php //echo $name; ?></p>
                    </div>
                    <div class="profile-input age-view">
                        <label>Age</label>
                        <p style="text-align: center;" id="age"><?php //echo $age ?></p>
                    </div>
                    <div  >
                        <label>Email</label>
                        <p id="email"><?php //echo $email ?></p>
                    </div>
                    <div  >
                        <label>Phone Number</label>
                        <p id="phone"><?php //echo $phone ?></p>
                    </div>

                    <div  >
                        <label>Location</label>
                        <p id="location" style="text-align: center;">
                            <?php //echo !empty($location) ? $location : '<span class="emptydetails">No location provided</span>'; ?>
                        </p>
                    </div>
                    <div  >
                        <label>Bio</label>
                        <p id="bio"><?php //echo $bio ?></p>
                    </div> -->
                    <?php
                    $_SESSION['id'] = "E1"; // Simulating a logged-in user for demonstration
                    // Check if the user is logged in and matches the profile being viewed
                    if (isset($_SESSION['id']) && $_SESSION['id'] == $userId) {
                        echo '<div  id="contain-buttons">';
                        echo '<button class="edit-profile-btn" onclick="window.location.href=\'profileform.php\'">Edit Profile</button>';
                        echo '</div>';
                    }
                    ?>

                </div>
            </div>
            <?php
            if ($prefix === 'E') {
                include('portfolio.php');
            }

            ?>

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