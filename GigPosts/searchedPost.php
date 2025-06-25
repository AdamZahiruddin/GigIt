<?php
include("../nav.php");
require("../inc/connect.php");

$results = [];
$postsPerPage = 5;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $postsPerPage;
$totalPosts = 0;
$searchTerm = '';

if (isset($_GET['name']) && trim($_GET['name']) !== '') {
    $keyword = strtolower(trim($_GET['name']));
    $searchTerm = "%" . $keyword . "%";

    // Count total matching posts for pagination
    $countSql = "SELECT COUNT(*) as total FROM post WHERE LOWER(title) LIKE '$searchTerm' AND status != 'Deactivated'";
    $countResult = $connect->query($countSql);
    $totalPosts = $countResult ? $countResult->fetch_assoc()['total'] : 0;

    // Fetch paginated results
    $sql = "SELECT * FROM post WHERE LOWER(title) LIKE '$searchTerm' AND status != 'Deactivated' 
    LIMIT $postsPerPage OFFSET $offset ";
    $query = $connect->query($sql);

    while ($row = $query->fetch_assoc()) {
        $results[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Similar Posts - GigIt</title>
  <link rel="stylesheet" href="../styling/stylegig.css">
  <link rel="stylesheet" href="../styling/stylePost.css">
</head>
<body class="lightmode">
 <?php include("../topbar.php");?>
    
  <div class="mid-section">
    <h2 class="create-title">Similar Posts</h2>

    <?php if (isset($_GET['name']) && trim($_GET['name']) !== ''): ?>
      <?php if (!empty($results)): ?>
        <?php foreach ($results as $post): ?>
          <a class="post-link-wrapper" href="viewPost.php?postID=<?= $post['postID'] ?>" style="text-decoration: none; color: inherit;">
            <div class="post-containers">
              <h2 class="post-title"><?= ucwords(htmlspecialchars($post['title'])) ?></h2>
              <p><?= htmlspecialchars($post['description']) ?></p>
            </div>
          </a>
        <?php endforeach; ?>

        <!-- Pagination -->
        <div style="margin: 1rem 0;">
          <?php if ($page > 1): ?>
            <a href="searchedPost.php?name=<?= urlencode($_GET['name']) ?>&page=<?= $page - 1 ?>">Previous</a>
          <?php endif; ?>
          <?php if ($offset + $postsPerPage < $totalPosts): ?>
            <a href="searchedPost.php?name=<?= urlencode($_GET['name']) ?>&page=<?= $page + 1 ?>" style="margin-left: 1rem;">Next</a>
          <?php endif; ?>
        </div>
      <?php else: ?>
        <p style="margin-left: 2rem;">No results found for "<strong><?= htmlspecialchars($_GET['name']) ?></strong>".</p>
      <?php endif; ?>
    <?php else: ?>
      <p style="margin-left: 2rem;">Please enter a search term.</p>
    <?php endif; ?>
  </div>
</body>
</html>
