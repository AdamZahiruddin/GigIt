<?php
session_start();
include("connect.php");

// Whose profile are we viewing
$viewedUserId = $_GET['id'] ?? $_SESSION['id']; // default to logged in user's own profile

// Who is logged in
$loggedInUserId = $_SESSION['id'] ?? 'E1';

// Read portfolio from DB
$stmt = $conn->prepare("SELECT * FROM portfolio WHERE user_id = ?");
$stmt->bind_param("i", $viewedUserId);
$stmt->execute();
$result = $stmt->get_result();
?>

<article class="container portfolio">
    <form action="save_portfolio.php" method="post" enctype="multipart/form-data">
        <div class="portfolio-header">
            <h2 style="margin: 10px 0;">Portfolio</h2>
            <p class="subtext">Showcase your work or projects here</p>
        </div>

        <div class="portfolio-items">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="Portfolio Item" class="portfolio-item">
                <?php endwhile; ?>
            <?php else: ?>
                <p class="subtext bold blue">No portfolio items yet. Add some to showcase your work!</p>
            <?php endif; ?>
        </div>

        <?php if ($viewedUserId == $loggedInUserId): ?>
        <div class="portfolio-actions">
            <input type="file" name="portfolio_image" required>
            <button type="submit" class="add-portfolio-btn">Add Portfolio Item</button>
        </div>
        <?php endif; ?>
    </form>
</article>
