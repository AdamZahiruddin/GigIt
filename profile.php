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
      

        <div class="search-notify-container" >
            <form class="search-bar" action="search.html" method="get">
                <input type="text" placeholder="Search..." id="searchinput" name="search"
                    style="padding: 6px 10px; border-radius: 4px; border: 1px solid #ccc;">
                <button id="searchsubmit" type="submit" style="background: none; border: none; cursor: pointer; margin-left: 4px;">
                    <img src="https://cdn-icons-png.flaticon.com/512/622/622669.png" alt="Search" width="20"
                        height="20">
                </button>
            </form>
            <div>

            <?php include ("notification.php");?>
        </div>

    </div>

    <div class="mid-section">




        <div class="sprofileform">
            <h1>Profile</h1>



            <form action="profile.html" method="post">
                <!-- <div class="profile-pic-container">
                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Default Avatar"
                        class="profile-pic">

                    <label for="upload-photo" class="upload-btn">
                        📷
                    </label>
                    <input type="file" id="upload-photo" style="display: none;">
                </div> -->
                <div class="profile-pic-container">
                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Default Avatar"
                        class="profile-pic">

                    <label for="upload-photo" class="upload-btn">
                        <img src="https://cdn-icons-png.flaticon.com/512/747/747545.png" alt="Upload" />
                    </label>
                    <input type="file" id="upload-photo" style="display: none;">
                </div>
                <div class="container">
                    <p class="subtext" style="text-align: left;">Update your profile details here</p>
                    <div class="contain-input">
                        <label for="name">Name</label>
                        <input type="text" id="name" required
                            placeholder="Enter your name for others to refer to you...." />
                    </div>
                    <div class="contain-input">
                        <label for="email">Email</label>
                        <input type="email" id="email" required placeholder="example@gmail.com" />
                    </div>
                    <div class="contain-input">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" required placeholder="+6012345678" />
                    </div>

                    <div class="contain-input age-input">
                        <label for="age">Age</label>
                        <input type="number" id="age" min="0" max="120" placeholder="Enter your age" required />
                    </div>

                    <div class="contain-input">
                        <label for="location">Location</label>
                        <input type="text" id="location" placeholder="Enter your location..." required />
                        <div class="contain-input">
                            <label for="bio">Bio</label>
                            <textarea id="bio" rows="4" cols="50" placeholder="Tell us about yourself..."></textarea>
                        </div>
                        <div id="contain-buttons">
                            <button type="reset">Clear</button>
                            <button type="submit">Update Profile</button>
                        </div>

                    </div>
                </div>
            </form>
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