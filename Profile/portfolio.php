<?php

include("../inc/connect.php");

$viewedUserId = $_GET['employeeID'] ?? $_SESSION['employeeID'];
$loggedInUserId = $_SESSION['employeeID'] ;

$stmt = $connect->prepare("SELECT * FROM portfolio WHERE employeeID = ?");
$stmt->bind_param("s", $viewedUserId);
$stmt->execute();
$result = $stmt->get_result();
$portfolioItems = $result->fetch_all(MYSQLI_ASSOC);
?>

<article class="portcontainer portfolio">
    <div class="portfolio-header">
        <h2>Portfolio</h2>
        <p class="subtext">Showcase your work or projects here</p>
    </div>

    <div class="portfolio-items">
        <?php if (!empty($portfolioItems)): ?>
            <?php foreach ($portfolioItems as $row): ?>
                <div class="portfolio-block">
                    <?php if (!empty($row['pfTitle'])): ?>
                        <h2 style="font-size: 24px;" class="caption"><?= htmlspecialchars($row['pfTitle']) ?></h2>
                    <?php endif; ?>
                    <img src="<?= htmlspecialchars($row['pfPicture']) ?>" class="portfolio-img">
                    <?php if (!empty($row['pfDesc'])): ?>
                        <p class="caption"><?= htmlspecialchars($row['pfDesc']) ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="subtext bold blue">No portfolio items yet. Add some to showcase your work!</p>
        <?php endif; ?>
    </div>

    <?php if ($viewedUserId == $loggedInUserId && count($portfolioItems) < 3): ?>
        <button class="show-upload-form-btn" onclick="toggleUploadForm()">+ Add Portfolio</button>

        <div class="portfolio-block upload-card" id="upload-form" style="display: none;">
            <form action="save_portfolio.php" method="post" enctype="multipart/form-data">
                <div class="portfolio-title">
                    <label>Title</label>
                    <input type="text" name="portfolio_title" maxlength="255">
                </div>
                <div class="portfolio-actions">
                    <label>Upload Image</label>
                    <label for="portfolio_image" style="cursor:pointer; display:inline-block;">
                        <span style="font-size:32px; color:#3498db; vertical-align:middle;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#3498db" viewBox="0 0 24 24">
                                <path d="M19 19H5V5h7V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7z"/>
                                <path d="M21 1h-6c-.55 0-1 .45-1 1s.45 1 1 1h3.59l-9.83 9.83c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L20 3.41V7c0 .55.45 1 1 1s1-.45 1-1V2c0-.55-.45-1-1-1z"/>
                            </svg>
                        </span>
                        <span style="margin-left:8px; color:#3498db; font-weight:500; vertical-align:middle;"></span>
                        <input type="file" name="portfolio_image" id="portfolio_image" accept="image/*" required style="display:none;">
                    </label>
                </div>
                <div class="portfolio-caption">
                    <label>Caption (optional)</label>
                    <input type="text" name="portfolio_caption" maxlength="255">
                </div>
                <button type="submit" class="add-portfolio-btn">Upload</button>
            </form>
        </div>
    <?php endif; ?>
</article>

<script>
    function toggleUploadForm() {
        const form = document.getElementById('upload-form');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>