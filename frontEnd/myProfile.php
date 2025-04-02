<?php
session_start();
include 'navigation.php';
include '../backEnd/database.php'; // make sure this uses PDO

if (!isset($_SESSION['userId'])) {
  header("Location: ../backEnd/login.php");
  exit();
}

$userId = $_SESSION['userId'];

// Fetch user info
$userStmt = $conn->prepare("SELECT firstName, email, username, avatar FROM users WHERE userId = ?");
$userStmt->execute([$userId]);
$user = $userStmt->fetch(PDO::FETCH_ASSOC);

// Fetch user posts with images
$postsStmt = $conn->prepare("SELECT * FROM posts WHERE userId = ? ORDER BY postId DESC");
$postsStmt->execute([$userId]);
$posts = $postsStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>My Profile</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  <main class="post-container">
    <h2 class="explore-title">Welcome, <?= htmlspecialchars($user['firstName']) ?>!</h2>
    <p style="color:white; text-align:center;">Username: <strong><?= htmlspecialchars($user['username']) ?></strong></p>
    <p style="color:white; text-align:center;">Email: <strong><?= htmlspecialchars($user['email']) ?></strong></p>

    <?php if (count($posts) > 0): ?>
      <?php foreach ($posts as $post): ?>
        <div class="post-card">
          <div class="post-header">
            <?php if (!empty($user['avatar'])): ?>
              <?php
                $avatarMime = (new finfo(FILEINFO_MIME_TYPE))->buffer($user['avatar']);
                $avatarBase64 = base64_encode($user['avatar']);
              ?>
              <img class="avatar" src="data:<?= $avatarMime ?>;base64,<?= $avatarBase64 ?>" alt="User Avatar">
            <?php endif; ?>
            <span class="username"><?= htmlspecialchars($user['firstName']) ?></span>
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

        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="no-posts">You haven't posted anything yet.</p>
    <?php endif; ?>
  </main>
  <footer>
    <?php include 'footer.php'; ?>
  </footer>
</body>
</html>
