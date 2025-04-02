<?php
  session_start();
  require_once '../backEnd/database.php';

  // Fetch posts from the database, ordering by the most recent post
  $sql = "SELECT * FROM posts ORDER BY postId DESC";
  $postsStmt = $conn->prepare("
  SELECT posts.*, users.firstName, users.avatar 
  FROM posts 
  JOIN users ON posts.userId = users.userId
  ORDER BY posts.postId DESC
");
$postsStmt->execute();
$posts = $postsStmt->fetchAll(PDO::FETCH_ASSOC);
  include 'navigation.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="WireFrame - Share your ultimate desk setup!" />
  <title>WireFrame - Welcome</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="../js/scripts.js"></script>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body class="home-page">
  <header>
    
  </header>



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

        <p class="post-description">#<?= htmlspecialchars($post['description']) ?></p>

        <button class="like-button">❤️ Like</button>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p class="no-posts">No posts found.</p>
  <?php endif; ?>
</section>
</body>
</html>
