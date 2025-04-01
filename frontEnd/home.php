<?php
  session_start();
  require_once '../backEnd/database.php';

  // Fetch posts from the database, ordering by the most recent post
  $sql = "SELECT * FROM posts ORDER BY postId DESC";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
  <style>
    /* Container for posts with a responsive grid layout */
    .post-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
      padding: 20px;
    }
    /* Each post card with a simple border and shadow */
    .post-card {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
    }
    /* Post title styling */
    .post-card h2 {
      margin: 0;
      padding: 10px;
      background: #f7f7f7;
      text-align: center;
      font-size: 1.2rem;
    }
    /* Image container with fixed height and hidden overflow */
    .post-card-image {
      width: 100%;
      height: 300px; /* Adjust height as needed */
      overflow: hidden;
      position: relative;
    }
    /* Ensure the image fills the container without distortion */
    .post-card-image img {
      width: 100% !important;
      height: 100% !important;
      object-fit: cover;
      display: block;
    }
  </style>
</head>
<body class="home-page">
  <header>
    <nav class="default-nav">
      <div class="logo-container">
        <a href="home.php">
          <img src="../img/FullLogo_Transparent.png" alt="Header Logo" />
        </a>
      </div>
      <ul class="header-right-menu">
        <li><a href="home.php">Home</a></li>
        <li><a href="explore.php">Explore</a></li>
        <li>
          <label for="account-burger" class="account-label">My Account</label>
          <input id="account-burger" type="checkbox" />
          <ul class="account-dropdown">
            <li><a href="#">My Profile</a></li>
            <li><a href="#">Favourites</a></li>
            <li><a href="../frontEnd/create_post.php">Upload</a></li>
            <li><a href="#">Manage Account</a></li>
            <li><a href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>

  <nav class="scrolled-header">
    <div class="top-icons">
      <a href="home.php"><img src="../img/IconOnly_Transparent_NoBuffer.png" alt="Logo" /></a>
      <a href="explore.php"><img src="../img/eye.png" alt="Explore" /></a>
      <a href="../frontEnd/create_post.php"><img src="../img/plus.png" alt="Upload" /></a>
      <a href="favourites.php"><img src="../img/heart.png" alt="Favourites" /></a>
    </div>
    <div class="bottom-icons">
      <a href="My Profile.php"><img src="../img/profile.png" alt="My Profile" /></a>
      <a href="#"><img src="../img/logout.png" alt="Logout" /></a>
    </div>
  </nav>

  <section class="post-container">
    <?php if(count($posts) > 0): ?>
      <?php foreach($posts as $post): ?>
        <div class="post-card">
          <h2><?php echo htmlspecialchars($post['title']); ?></h2>
          <div class="post-card-image">
            <?php
              if (!empty($post['image'])) {
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mimeType = $finfo->buffer($post['image']);
                $base64Image = base64_encode($post['image']);
                echo '<img src="data:' . $mimeType . ';base64,' . $base64Image . '" alt="' . htmlspecialchars($post['title']) . '">';
              }
            ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No posts found.</p>
    <?php endif; ?>
  </section>
</body>
</html>
