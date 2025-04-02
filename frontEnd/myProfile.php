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
$userStmt = $conn->prepare("SELECT firstName, email, username FROM users WHERE userId = ?");
$userStmt->execute([$userId]);
$user = $userStmt->fetch(PDO::FETCH_ASSOC);

// Fetch user posts
$postsStmt = $conn->prepare("SELECT title, description FROM posts WHERE userId = ?");
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
  <main class="profile-wrapper">
    <div class="profile-header">
      <h2>Welcome, <?= htmlspecialchars($user['firstName']) ?>!</h2>
      <div class="user-info">
        <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
      </div>
    </div>

    <div class="profile-posts">
      <h3>Your Posts</h3>
      <div class="post-grid">
        <?php if (count($posts) > 0): ?>
          <?php foreach ($posts as $post): ?>
            <div class="post-card">
              <h4><?= htmlspecialchars($post['title']) ?></h4>
              <p><?= htmlspecialchars($post['description']) ?></p>
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