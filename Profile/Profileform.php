<?php
session_start();
include "../nav.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GigIt Profile</title>

    <link rel="stylesheet" href="../styling/stylegigger.css">
    <link rel="stylesheet" href="../styling/profile.css">
</head>

<body class="lightmode">
    <div class="logo light">GigIt</div>

   <?php include "../topbar.php";?>
    <div>

        <div class="sprofileform">
            <h1>Profile</h1>



            <?php

            include("../inc/connect.php"); // Make sure this file sets up $conn
            
            // Determine user type and ID
            $userType = '';
            $userId = '';
            if (isset($_SESSION['employeeID'])) {
                $userType = 'employee';
                $userId = $_SESSION['employeeID'];
                $query = "SELECT name, email, phone, age, location, bio, profile_pic FROM employee WHERE employeeID = ?";
            } elseif (isset($_SESSION['employerID'])) {
                $userType = 'employer';
                $userId = $_SESSION['employerID'];
                $query = "SELECT name, email, phone, age, location, bio, profile_pic FROM employer WHERE employerID = ?";
            } else {
                // Not logged in
                echo "<p>Please log in to edit your profile.</p>";
                exit;
            }

            $stmt = $connect->prepare($query);
            $stmt->bind_param("s", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            // Set default values if not found
            $name = isset($user['name']) ? htmlspecialchars($user['name']) : '';
            $email = isset($user['email']) ? htmlspecialchars($user['email']) : '';
            $phone = isset($user['phone']) ? htmlspecialchars($user['phone']) : '';
            $age = isset($user['age']) ? htmlspecialchars($user['age']) : '';
            $location = isset($user['location']) ? htmlspecialchars($user['location']) : '';
            $bio = isset($user['bio']) ? htmlspecialchars($user['bio']) : '';
            $profilePic = !empty($user['profile_pic']) ? htmlspecialchars($user['profile_pic']) : "https://cdn-icons-png.flaticon.com/512/149/149071.png";
            ?>

            <form action="updateProfile.php" method="post" enctype="multipart/form-data">
                <div class="profile-pic-container">
                    <img src="<?php echo $profilePic; ?>" alt="Profile Avatar" class="profile-pic">
                    <label for="upload-photo" class="upload-btn">
                        <img src="https://cdn-icons-png.flaticon.com/512/747/747545.png" alt="Upload" />
                    </label>
                    <input type="file" name="profile_pic" accept='image/*' id="upload-photo" style="display: none;">
                    <script>
                        // Default file size limit: 2MB (can be adjusted)
                        const MAX_FILE_SIZE = 2 * 1024 * 1024; // 2MB

                        document.addEventListener('DOMContentLoaded', function () {
                            const uploadInput = document.getElementById('upload-photo');
                            uploadInput.addEventListener('change', function (event) {
                                const file = event.target.files[0];
                                if (file) {
                                    if (file.size > MAX_FILE_SIZE) {
                                        alert('File is too large. Please select a file smaller than 2MB.');
                                        uploadInput.value = '';
                                        return;
                                    }
                                    if (file.type.startsWith('image/')) {
                                        const reader = new FileReader();
                                        reader.onload = function (e) {
                                            document.querySelector('.profile-pic').src = e.target.result;
                                        };
                                        reader.readAsDataURL(file);
                                    }
                                }
                            });
                        });
                    </script>
                </div>
                <div class="container">
                    <p class="subtext" style="text-align: left;">Update your profile details here</p>
                    <div class="contain-input">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" required
                            placeholder="Enter your name for others to refer to you...." value="<?php echo $name; ?>" />
                    </div>
                    <div class="contain-input">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required placeholder="example@gmail.com"
                            value="<?php echo $email; ?>" />
                    </div>
                    <div class="contain-input">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" required placeholder="+6012345678"
                            value="<?php echo $phone; ?>" />
                    </div>
                    <div class="contain-input age-input">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" min="0" max="120" placeholder="Enter your age" required
                            value="<?php echo $age; ?>" />
                    </div>
                    <div class="contain-input">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" placeholder="Enter your location..." required
                            value="<?php echo $location; ?>" />
                        <div class="contain-input">
                            <label for="bio">Bio</label>
                            <textarea id="bio" name="bio" rows="4" cols="50"
                                placeholder="Tell us about yourself..."><?php echo $bio; ?></textarea>
                        </div>
                        <div id="contain-buttons">
                            <button type="button" onclick="window.location.href='profile.php'">Cancel</button>
                            <button type="reset">Clear</button>
                            <button type="submit">Update Profile</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </form>
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