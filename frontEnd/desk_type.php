<?php
require_once '../backEnd/database.php';
session_start();
include 'navigation.php';

// Get desk type from URL
$deskType = isset($_GET['type']) ? $_GET['type'] : null;

if (!$deskType) {
    echo "<p style='color:white; text-align:center;'>No desk type specified.</p>";
    exit();
}

// Prepare readable titles
$typeLabels = [
    'gaming-desk' => 'Gaming Desk',
    'minimalist-desk' => 'Minimalist Desk',
    'luxury-desk' => 'Luxury Office Desk',
    'productivity-desk' => 'Productivity Desk',
    'corner-desk' => 'Cozy Corner Desk',
    'streaming-desk' => 'Streaming Desk'
];

$displayTitle = $typeLabels[$deskType] ?? 'Unknown Desk Type';

// Fetch posts for this type
$stmt = $conn->prepare("SELECT posts.*, users.firstName, users.avatar FROM posts JOIN users ON posts.userId = users.userId WHERE posts.description = :deskType ORDER BY posts.postId DESC");
$stmt->execute([':deskType' => $deskType]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($displayTitle) ?> - Desk Posts</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<main class="post-container">
  <h2 class="explore-title" style="text-align: center; color: white; margin-bottom: 30px;">
    <?= htmlspecialchars($displayTitle) ?> Setups
  </h2>

  <?php if ($posts): ?>
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

        <p class="post-description">#<?= htmlspecialchars($displayTitle) ?></p>
        
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p style="color:white; text-align:center;">No posts yet for this desk type.</p>
  <?php endif; ?>
</main>
<?php include 'footer.php'; ?>
</body>
</html>
