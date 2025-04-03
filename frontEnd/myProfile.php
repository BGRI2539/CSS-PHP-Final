<?php
session_start();
include 'navigation.php';
include '../backEnd/database.php';

if (!isset($_SESSION['userId'])) {
  header("Location: ../backEnd/login.php");
  exit();
}

$userId = $_SESSION['userId'];

// Fetch user info
$userStmt = $conn->prepare("SELECT firstName, email, username, avatar FROM users WHERE userId = ?");
$userStmt->execute([$userId]);
$user = $userStmt->fetch(PDO::FETCH_ASSOC);

// Fetch user posts
$postsStmt = $conn->prepare("SELECT title, description, image FROM posts WHERE userId = ?");
$postsStmt->execute([$userId]);
$posts = $postsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>My Profile - WireFrame</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body class="home-page">

<main class="profile-wrapper">
  <div class="profile-header">
    <div class="profile-top">
      <?php if (!empty($user['avatar'])): ?>
        <?php
          $avatarMime = (new finfo(FILEINFO_MIME_TYPE))->buffer($user['avatar']);
          $avatarBase64 = base64_encode($user['avatar']);
        ?>
        <img class="profile-avatar" src="data:<?= $avatarMime ?>;base64,<?= $avatarBase64 ?>" alt="Profile Picture">
      <?php endif; ?>
      <h2><?= htmlspecialchars($user['firstName']) ?></h2>
    </div>

    <div class="user-info-box">
      <a href="manageAccount.php" class="edit-profile-btn">Edit Account</a>
      <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    </div>
  </div>

  <div class="profile-posts">
    <h3>Your Desk Posts</h3>
    <div class="posts-grid">
      <?php if (count($posts) > 0): ?>
        <?php foreach ($posts as $post): ?>
          <div class="post-card">
            <h4 class="post-title"><?= htmlspecialchars($post['title']) ?></h4>
            <?php if (!empty($post['image'])): ?>
              <?php
                $mime = (new finfo(FILEINFO_MIME_TYPE))->buffer($post['image']);
                $img = base64_encode($post['image']);
              ?>
              <img class="post-image" src="data:<?= $mime ?>;base64,<?= $img ?>" alt="<?= htmlspecialchars($post['title']) ?>">
            <?php endif; ?>
            <p class="post-description">#<?= htmlspecialchars($post['description']) ?></p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="no-posts">You haven't posted anything yet.</p>
      <?php endif; ?>
    </div>
  </div>
</main>

<footer>
  <?php include 'footer.php'; ?>
</footer>

</body>
</html>