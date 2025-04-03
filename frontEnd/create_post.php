<?php include 'navigation.php'; ?>
<?php require_once '../backEnd/post.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create a New Post</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<main class="create-post-wrapper">
  <h1>Create a New Post</h1>
  <form action="create_post.php" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
      <label for="title">Post Title:</label>
      <input type="text" id="title" name="title" placeholder="e.g., My Ultimate Setup" required>
    </div>

    <div class="form-group">
      <label for="image">Upload Image:</label>
      <input type="file" id="image" name="image" accept="image/*" required>
    </div>

    <div class="form-group">
      <label for="description">Desk Type:</label>
      <select name="description" id="description" required>
        <option disabled selected value="">-- Choose a desk type --</option>
        <option value="gaming-desk">Gaming Desk</option>
        <option value="minimalist-desk">Minimalist Desk</option>
        <option value="luxury-desk">Luxury Office Desk</option>
        <option value="productivity-desk">Productivity Desk</option>
        <option value="corner-desk">Cozy Corner Desk</option>
        <option value="streaming-desk">Streaming Desk</option>
      </select>
    </div>

    <div class="form-group">
      <button type="submit">Submit Post</button>
    </div>
  </form>
</main>

<?php include 'footer.php'; ?>
</body>
</html>