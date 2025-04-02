<?php
session_start();
require_once '../backEnd/database.php';

$postsStmt = $conn->prepare("
  SELECT posts.*, users.firstName, users.avatar 
  FROM posts 
  JOIN users ON posts.userId = users.userId
  ORDER BY posts.postId DESC
");
$postsStmt->execute();
$posts = $postsStmt->fetchAll(PDO::FETCH_ASSOC);

include 'navigation.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="WireFrame - Share your ultimate desk setup!" />
  <title>WireFrame - Home</title>
  <link rel="stylesheet" href="../css/style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="../js/scripts.js"></script>
</head>
<body class="home-page">

<nav class="scrolled-header">
  <div class="top-icons">
    <a href="home.php"><img src="../img/IconOnly_Transparent_NoBuffer.png" alt="Logo" /></a>
    <a href="explore.php"><img src="../img/eye.png" alt="Explore" /></a>
    <a href="create_post.php"><img src="../img/plus.png" alt="Upload" /></a>
    <a href="favourites.php"><img src="../img/heart.png" alt="Favourites" /></a>
  </div>
  <div class="bottom-icons">
    <a href="myProfile.php"><img src="../img/profile.png" alt="My Profile" /></a>
    <a href="../backEnd/logout.php"><img src="../img/logout.png" alt="Logout" /></a>
  </div>
</nav>

<section class="post-container">
  <?php if (count($posts) > 0): ?>
    <?php foreach ($posts as $post): ?>
      <div class="post-card">
        <div class="post-header">
          <?php if (!empty($post['avatar'])): ?>
            <?php
              $avatarMime = (new finfo(FILEINFO_MIME_TYPE))->buffer($post['avatar']);
              $avatarBase64 = base64_encode($post['avatar']);
            ?>
            <img class="avatar" src="data:<?= $avatarMime ?>;base64,<?= $avatarBase64 ?>" alt="User Avatar">
          <?php endif; ?>
          <span class="username"><?= htmlspecialchars($post['firstName']) ?></span>
        </div>

        <h2 class="post-title"><?= htmlspecialchars($post['title']) ?></h2>

        <div class="post-card-image">
          <?php if (!empty($post['image'])): ?>
            <?php
              $mimeType = (new finfo(FILEINFO_MIME_TYPE))->buffer($post['image']);
              $base64Image = base64_encode($post['image']);
            ?>
            <img src="data:<?= $mimeType ?>;base64,<?= $base64Image ?>" alt="<?= htmlspecialchars($post['title']) ?>">
          <?php endif; ?>
        </div>

        <?php
          $deskDescriptions = [
            'gaming-desk' => 'Gaming Desk',
            'minimalist-desk' => 'Minimalist Desk',
            'luxury-desk' => 'Luxury Office Desk',
            'productivity-desk' => 'Productivity Desk',
            'corner-desk' => 'Cozy Corner Desk',
            'streaming-desk' => 'Streaming Desk'
          ];
          $descKey = $post['description'];
          $descLabel = $deskDescriptions[$descKey] ?? $descKey;
        ?>
        <p class="post-description">#<?= htmlspecialchars($descLabel) ?></p>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p class="no-posts">No posts found.</p>
  <?php endif; ?>
</section>

</body>
</html>