<?php
require_once '../backEnd/database.php';
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

$displayTitle = isset($typeLabels[$deskType]) ? $typeLabels[$deskType] : 'Unknown Desk Type';

// Fetch posts with this type as description
$stmt = $conn->prepare("SELECT title, image FROM posts WHERE description = :deskType");
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
  <main class="explore-wrapper">
    <h2 class="explore-title"><?= htmlspecialchars($displayTitle) ?> Posts</h2>

    <div class="gallery-grid">
      <?php if ($posts): ?>
        <?php foreach ($posts as $post): ?>
          <div class="post-card">
            <strong><?= htmlspecialchars($post['title']) ?></strong><br>
            <?php if (!empty($post['image'])): ?>
              <img src="data:image/jpeg;base64,<?= base64_encode($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" style="width: 100%; border-radius: 12px; margin-top: 10px;">
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="color:white; text-align:center;">No posts yet for this desk type.</p>
      <?php endif; ?>
    </div>
  </main>
  <?php include 'footer.php'; ?>
</body>
</html>