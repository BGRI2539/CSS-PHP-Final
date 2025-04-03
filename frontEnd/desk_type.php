<?php
require_once '../backEnd/database.php';
include 'navigation.php';

$deskType = $_GET['type'] ?? null;

if (!$deskType) {
  echo "<p style='color:white; text-align:center;'>No desk type specified.</p>";
  exit();
}

$typeLabels = [
  'gaming-desk' => 'Gaming Desk',
  'minimalist-desk' => 'Minimalist Desk',
  'luxury-desk' => 'Luxury Office Desk',
  'productivity-desk' => 'Productivity Desk',
  'corner-desk' => 'Cozy Corner Desk',
  'streaming-desk' => 'Streaming Desk'
];

$displayTitle = $typeLabels[$deskType] ?? 'Unknown Desk Type';

$stmt = $conn->prepare("
  SELECT posts.*, users.firstName, users.avatar 
  FROM posts 
  JOIN users ON posts.userId = users.userId 
  WHERE posts.description = :deskType 
  ORDER BY posts.postId DESC
");
$stmt->execute([':deskType' => $deskType]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($displayTitle) ?> - Desk Posts</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  <main class="post-container">
    <h2 class="explore-title"><?= htmlspecialchars($displayTitle) ?> Setups</h2>

    <?php if (count($posts) > 0): ?>
      <?php foreach ($posts as $post): ?>
        <div class="post-card">
          <div class="post-header">
            <?php if (!empty($post['avatar'])): ?>
              <?php
                $avatarMime = (new finfo(FILEINFO_MIME_TYPE))->buffer($post['avatar']);
                $avatarBase64 = base64_encode($post['avatar']);
              ?>
              <img class="avatar" src="data:<?= $avatarMime ?>;base64,<?= $avatarBase64 ?>" alt="User Avatar" />
            <?php endif; ?>
            <span class="username"><?= htmlspecialchars($post['firstName']) ?></span>
          </div>

          <h2 class="post-title"><?= htmlspecialchars($post['title']) ?></h2>

          <div class="post-card-image">
            <?php if (!empty($post['image'])): ?>
              <?php
                $imageMime = (new finfo(FILEINFO_MIME_TYPE))->buffer($post['image']);
                $imageBase64 = base64_encode($post['image']);
              ?>
              <img src="data:<?= $imageMime ?>;base64,<?= $imageBase64 ?>" alt="<?= htmlspecialchars($post['title']) ?>" />
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
      <p class="no-posts">No posts found for this desk type.</p>
    <?php endif; ?>
  </main>

  <?php include 'footer.php'; ?>
</body>
</html>