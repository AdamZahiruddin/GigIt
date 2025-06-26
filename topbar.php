<link rel="stylesheet" href="styling/stylegigger.css">
<div class="top-bar" style="min-height: 50px;">
    <div class="search-notify-container">
        <!-- Reusable Search Bar -->
        <form class="search-bar" style="margin-bottom: 0;"action="/GigIt/GigPosts/searchedPost.php" method="get">
            <input type="text" id="searchinput" name="name" placeholder="Search..."
                value="<?= htmlspecialchars($_GET['name'] ?? '') ?>" required>
            <button id="searchsubmit" type="submit">
                <img src="https://cdn-icons-png.flaticon.com/512/622/622669.png" alt="Search" width="20" height="20">
            </button>
        </form>
          
             <?php

        include("../notification.php");
        
        ?> 
        
    </div>

</div>